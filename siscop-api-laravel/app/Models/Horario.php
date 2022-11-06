<?php

namespace App\Models;

use Database\Factories\HorarioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Horario
 *
 * @property int $id
 * @property int $dia_semana
 * @property string $horario_entrada
 * @property string $horario_saida
 * @property int|null $funcionario_id
 * @property int|null $user_id
 * @property int|null $turma_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\HorarioFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Horario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Horario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereDiaSemana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereFuncionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereHorarioEntrada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereHorarioSaida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereTurmaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|Horario onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Horario withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Horario withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Horario whereDeletedAt($value)
 */
class Horario extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public static function newFactory(): Factory
    {
        return HorarioFactory::new();
    }
}
