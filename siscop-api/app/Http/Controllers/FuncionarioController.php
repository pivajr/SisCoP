<?php

namespace App\Http\Controllers;

use App\Http\Resources\FuncionarioResource;
use App\Models\Funcionario;
use App\Queries\Base\Persistence;
use App\Queries\Persistence\FuncionarioPersistence;
use App\Queries\Select\Funcionario\SelectAll;
use App\Queries\Select\Funcionario\SelectById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Throwable;

/**
 * Class FuncionarioController
 * @package App\Http\Controllers
 */
class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $funcionarios = (new SelectAll())->query()->paginate();
        return FuncionarioResource::collection($funcionarios);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\FuncionarioResource
     * @throws Throwable
     */
    public function store(Request $request): FuncionarioResource
    {
        $funcionario = (new FuncionarioPersistence($request->all(), new Funcionario()))->executeWithTransaction();
        return new FuncionarioResource($funcionario);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \App\Http\Resources\FuncionarioResource
     */
    public function show(int $id): FuncionarioResource
    {
        $funcionario = (new SelectById($id))->first();
        return new FuncionarioResource($funcionario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Http\Resources\FuncionarioResource
     * @throws \Throwable
     */
    public function update(Request $request, int $id): FuncionarioResource
    {
        $funcionario = (new SelectById($id))->first();
        $funcionario = (new FuncionarioPersistence($request->all(), $funcionario))->executeWithTransaction();
        return new FuncionarioResource($funcionario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(int $id): JsonResponse
    {
        /**
         * @var Funcionario
         */
        $funcionario = (new SelectById($id))->first();
        $funcionario->delete();

        return response()->json([
            'id' => $funcionario->id
        ]);
    }
}
