<?php

namespace App\Http\Controllers;

use App\Http\Resources\PresencaResource;
use App\Models\MediaFile;
use App\Models\Presenca;
use App\Models\TurmaUser;
use App\Queries\Persistence\MediaFilePersistence;
use App\Queries\Persistence\PresencaPersistence;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PresencaController extends Controller
{
    /**
     * @throws Throwable
     */
    public function registrarPresenca(Request $request): PresencaResource
    {
        info($request);
        info($request->imagem);

        $now = Carbon::now();
        $existeTurmaHorario = DB::table('turma_users', 'tu')->
            join('turma_horarios as th', 'th.turma_id', '=', 'tu.turma_id')->
            where('tu.user_id', auth()->id())->
            where('th.ativo', true)->
            where('th.dia_semana', Carbon::now()->format('N'))->
            whereBetween(DB::raw("'".$now->format('H:i:s')."'"), [DB::raw('subtime(inicio, extensao)'), DB::raw('addtime(termino, addtime(extensao, \'00:00:59\'))')])->count();

        abort_if($existeTurmaHorario === 0, 404, 'Nenhuma turma foi encontrada nesse horário');

        $presenca = new Presenca();
        $presenca->imagem_id = (new MediaFilePersistence($request->all(), new MediaFile(), $request->file('imagem')))->execute()->id;
        $presenca = (new PresencaPersistence($request->all(), new Presenca()))->execute();

        return new PresencaResource($presenca);
    }
}
