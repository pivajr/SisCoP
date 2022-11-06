<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstituicaoResource;
use App\Models\Instituicao;
use App\Queries\Base\Paginator;
use App\Queries\Persistence\InstituicaoPersistence;
use App\Queries\Select\Instituicao\SelectAll;
use App\Queries\Select\Instituicao\SelectById;
use App\Queries\Select\Instituicao\SelectByUser;
use App\Queries\Select\InstituicaoStatus\SelectBySlug;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

/**
 * Class InstituicaoController
 * @package App\Http\Controllers
 */
class InstituicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $instituicoes = (new Paginator(new SelectByUser(auth()->id())))->with(['responsavel', 'status'])->paginate();
        return InstituicaoResource::collection($instituicoes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return InstituicaoResource
     * @throws Throwable
     */
    public function store(Request $request): InstituicaoResource
    {
        $instituicao = (new InstituicaoPersistence($request->all(), new Instituicao()))->executeWithTransaction();
        return new InstituicaoResource($instituicao);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return InstituicaoResource
     */
    public function show(int $id): InstituicaoResource
    {
        $instituicao = (new SelectById($id))->first();
        return new InstituicaoResource($instituicao);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return InstituicaoResource
     * @throws Throwable
     */
    public function update(Request $request, int $id): InstituicaoResource
    {
        /**
         * @var Instituicao
         */
        $instituicao = (new SelectById($id))->first();
        $instituicao = (new InstituicaoPersistence($request->all(), $instituicao))->executeWithTransaction(true);
        return new InstituicaoResource($instituicao);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $id): JsonResponse
    {
        /**
         * @var Instituicao
         */
        $instituicao = (new SelectById($id))->first();
        $instituicao->delete();

        return response()->json([
            'id' => $instituicao->id
        ]);
    }

    /**
     * @param Request $request
     * @return InstituicaoResource
     * @throws Throwable
     */
    public function avaliacao(Request $request): InstituicaoResource
    {
        $resultadoAvaliacao = (new SelectBySlug($request->avaliacao))->first();
        $instituicao = (new SelectById($request->instituicao_id))->first();

        $instituicao->update([
            'instituicao_status_id' => $resultadoAvaliacao->id
        ]);

        return new InstituicaoResource($instituicao);
    }
}
