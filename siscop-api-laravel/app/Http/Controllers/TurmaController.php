<?php

namespace App\Http\Controllers;

use App\Http\Resources\TurmaResource;
use App\Models\Turma;
use App\Queries\Base\Paginator;
use App\Queries\Persistence\TurmaPersistence;
use App\Queries\Select\Turma\SelectById;
use App\Queries\Select\Turma\SelectByIdInstituicao;
use App\Queries\Select\Turma\SelectByInstituicao;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Throwable;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $turmas = (new Paginator(new SelectByInstituicao(session()->get('instituicao')->id)))->with(['responsavel'])->paginate();
        return TurmaResource::collection($turmas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TurmaResource
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $turma = (new TurmaPersistence($request->all(), new Turma()))->executeWithTransaction();
        return new TurmaResource($turma);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TurmaResource
     * @throws Throwable
     */
    public function show($id)
    {
        $turma = (new SelectByIdInstituicao($id, session()->get('instituicao')->id))->query()->with(['responsavel', 'horarios'])->firstOrFail();
        return new TurmaResource($turma);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return TurmaResource
     * @throws Throwable
     */
    public function update(Request $request, int $id): TurmaResource
    {
        /**
         * @var Turma
         */
        $turma = (new SelectById($id))->query()->firstOrFail();
        $turma = (new TurmaPersistence($request->all(), $turma))->executeWithTransaction(true);
        return new TurmaResource($turma);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id): Response
    {
        abort(404);
    }
}
