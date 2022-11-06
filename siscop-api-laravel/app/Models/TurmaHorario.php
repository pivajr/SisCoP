<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\TurmaHorario
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario newQuery()
 * @method static \Illuminate\Database\Query\Builder|TurmaHorario onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario query()
 * @method static \Illuminate\Database\Query\Builder|TurmaHorario withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TurmaHorario withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $ativo
 * @property int $dia_semana
 * @property \Illuminate\Support\Carbon $inicio
 * @property \Illuminate\Support\Carbon $termino
 * @property \Illuminate\Support\Carbon $extensao
 * @property int $turma_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereDiaSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereExtensao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereTurmaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaHorario whereUpdatedAt($value)
 */
class TurmaHorario extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'inicio' => 'date:H:i',
        'termino' => 'date:H:i',
        'extensao' => 'date:H:i'
    ];
}
