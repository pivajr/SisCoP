<?php

namespace App\Models;

use Database\Factories\TurmaFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Turma
 *
 * @property int $id
 * @property int $instituicao_id
 * @property int $user_id
 * @property string $codigo_turma
 * @property string $curso
 * @property string $semestre
 * @property string $disciplina
 * @property Collection $horarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TurmaFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Turma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Turma query()
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereCodigoTurma($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereCurso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereDisciplina($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereSemestre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereUserId($value)
 * @mixin \Eloquent
 * @property-read int|null $horarios_count
 * @property-read \App\Models\Instituicao|null $instituicao
 * @property-read \App\Models\User|null $responsavel
 * @method static \Illuminate\Database\Query\Builder|Turma onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Turma withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Turma withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Turma whereDeletedAt($value)
 */
class Turma extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function horarios()
    {
        return $this->hasMany(TurmaHorario::class, 'turma_id');
    }

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public static function newFactory(): Factory
    {
        return TurmaFactory::new();
    }
}
