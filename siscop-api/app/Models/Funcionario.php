<?php

namespace App\Models;

use Database\Factories\FuncionarioFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Funcionario
 *
 * @property int $id
 * @property int $user_id
 * @property int $instituicao_id
 * @property int $horario_flexivel
 * @property int $solicita_validacao
 * @property int $qtd_horas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Instituicao $instituicao
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FuncionarioFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario query()
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereHorarioFlexivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereQtdHoras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereSolicitaValidacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FuncionarioEndereco[] $endereco
 * @property-read int|null $endereco_count
 * @method static \Illuminate\Database\Query\Builder|Funcionario onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Funcionario withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Funcionario withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionario whereDeletedAt($value)
 */
class Funcionario extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    /**
     * @return HasMany
     */
    public function endereco(): HasMany
    {
        return $this->hasMany(FuncionarioEndereco::class, 'functionario_id');
    }

    /**
     * @return Factory
     */
    public static function newFactory(): Factory
    {
        return FuncionarioFactory::new();
    }
}
