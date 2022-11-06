<?php

namespace App\Http\Controllers;

use App\Http\Resources\HorarioResource;
use App\Queries\Select\Horario\SelectAll;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HorarioController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $horarios = (new SelectAll())->query()->paginate();
        return HorarioResource::collection($horarios);
    }
}
