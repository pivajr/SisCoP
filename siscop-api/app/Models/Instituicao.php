<?php

namespace App\Models;

use Database\Factories\InstituicaoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Instituicao
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf_cnpj
 * @property string|null $atividade
 * @property int $responsavel_id
 * @property int $qtd_funcionarios
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\InstituicaoEndereco[] $enderecos
 * @property-read int|null $enderecos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Funcionario[] $funcionarios
 * @property-read int|null $funcionarios_count
 * @property-read \App\Models\User $responsavel
 * @method static \Database\Factories\InstituicaoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao query()
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereAtividade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereCpfCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereQtdFuncionarios($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereResponsavelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\InstituicaoStatus|null $status
 * @method static \Illuminate\Database\Query\Builder|Instituicao onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Instituicao withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Instituicao withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $instituicao_status_id
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instituicao whereInstituicaoStatusId($value)
 */
class Instituicao extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'instituicoes';

    public function funcionarios(): HasMany
    {
        return $this->hasMany(Funcionario::class, 'instituicao_id');
    }

    public function enderecos(): HasMany
    {
        return $this->hasMany(InstituicaoEndereco::class, 'instituicao_id');
    }

    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsavel_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(InstituicaoStatus::class, 'instituicao_status_id');
    }

    public static function newFactory(): Factory
    {
        return InstituicaoFactory::new();
    }
}
