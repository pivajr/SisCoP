<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserBasicResource;
use App\Http\Resources\UserResource;
use App\Models\Parametro;
use App\Models\TurmaUser;
use App\Models\User;
use App\Queries\Base\Paginator;
use App\Queries\Persistence\UserPersistence;
use App\Queries\Select\Turma\SelectByCodigoTurma;
use App\Queries\Select\User\SelectAll;
use App\Queries\Select\User\SelectByEmail;
use App\Queries\Select\User\SelectById;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

use Decimal\Decimal;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     */
    public function index(): AnonymousResourceCollection
    {
        $this->authorize('consulta', User::class);
        $users = (new Paginator(new SelectAll()))->paginate();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @throws Throwable
     */
    public function store(Request $request): AnonymousResourceCollection
    {
        info(">>> UserController: store");
        $this->authorize('cadastro', User::class);
        $users = collect([]);

        info($request);

        foreach ($request->usuarios as $usuarioData) {
            $user = (new SelectByEmail($usuarioData['email']))->first();

            if (!$user) {
                $user = (new UserPersistence($usuarioData, new User()))->executeWithTransaction();
            }

            $codigoTurma = $usuarioData['codigo_turma'] ?? null;

            if ($codigoTurma) {
                $turmaCount = $user->turmas()->join('turmas', 'turmas.id', '=', 'turma_users.turma_id')->where('codigo_turma', $codigoTurma)->count();

                if (!$turmaCount) {
                    $turmaUser = new TurmaUser();
                    $turmaUser->user_id = $user->id;
                    $turmaUser->instituicao_id = session()->get('instituicao')->id;
                    $turmaUser->turma_id = (new SelectByCodigoTurma($codigoTurma))->first()->id;

                    $user->turmas()->save($turmaUser);
                }
            }

            $users->push($user);
        }

        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource|Response
     */
    public function show(int $id)
    {
        $user = (new SelectById($id))->query()->firstOrFail();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return UserResource|Response
     * @throws Throwable
     */
    public function update(Request $request, int $id)
    {
        /**
         * @var User
         */
        $user = (new SelectById($id))->query()->firstOrFail();
        $user = (new UserPersistence($request->all(), $user))->executeWithTransaction(true);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $user = (new SelectById($id))->query()->firstOrFail();
        $user->delete();

        return response()->json([
            'id' => $user
        ]);
    }

    public function predict(Request $request)
    {
        $token = $request->predict_token;
        $listTokens = explode(';', base64_decode($token));
        $user = auth()->user();
        $minDist = 999;
        $threshold = optional(Parametro::where('codigo', 'precisao')->first())->valor ?? 0.6;
        $currDist = 0.0;
        $predRes = null;

        info('>>> token'.$token);
        info('>>>> listTokens'.collect($listTokens));
        info(">>>> threshold: $threshold");

        abort_if(is_null($user->predicted_token), 404);

        info('>>> user');
        info($user);
        $listUserDB = explode(';', base64_decode($user->predicted_token));
        $currDist = $this->euclideanDistance($listUserDB, $listTokens);

        info(">>> currDist: $currDist");

        if ($currDist <= $threshold && $currDist < $minDist) {
            $minDist = $currDist;
            $predRes = $user;
        }

        abort_if(is_null($predRes), 404);

        return new UserResource($predRes);
    }

    /**
     * @param string $email
     * @return UserBasicResource
     */
    public function findByEmail(string $email)
    {
        $user = (new SelectByEmail($email))->first();
        return new UserBasicResource($user);
    }

    /**
     * @param array $userDB
     * @param array $searchData
     * @return float
     * @throws Exception
     */
    private function euclideanDistance($userDB, $searchData): float
    {
        if (!$userDB || !$searchData) {
            throw new Exception("Argumento Nulo");
        }

        $sum = 0.0;

        for ($i = 0; $i < count($userDB); $i++) {
            $s1 = $userDB[$i];
            $s2 = $searchData[$i];
            $v1 = doubleval($s1);
            $v2 = doubleval($s2);
            $subtract = $v1 - $v2;
            $pow = pow($subtract, 2);
            $sum += $pow;
        }

        $result = sqrt($sum);

        info(">>> $result");

        return $result;
    }
}
