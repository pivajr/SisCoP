<?php

namespace App\Models;

use Database\Factories\InstituicaoEnsinoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\InstituicaoEnsino
 *
 * @property int $id
 * @property int $instituicao_id
 * @property string $nivel
 * @property int $qtd_estudantes
 * @property string $nivel_controle
 * @property string $tipo_instituicao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Instituicao $instituicao
 * @method static \Database\Factories\InstituicaoEnsinoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino query()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereNivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereNivelControle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereQtdEstudantes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereTipoInstituicao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEnsino onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEnsino withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEnsino withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEnsino whereDeletedAt($value)
 */
class InstituicaoEnsino extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public static function newFactory(): Factory
    {
        return InstituicaoEnsinoFactory::new();
    }
}
