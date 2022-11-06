<?php

namespace App\Models;

use Database\Factories\InstituicaoEnderecoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\InstituicaoEndereco
 *
 * @property int $id
 * @property int $instituicao_id
 * @property string $cep
 * @property string $uf
 * @property string $cidade
 * @property string $bairro
 * @property string $rua
 * @property string $numero
 * @property string $complemento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Instituicao $instituicao
 * @method static \Database\Factories\InstituicaoEnderecoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco query()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereComplemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereRua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEndereco onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEndereco withTrashed()
 * @method static \Illuminate\Database\Query\Builder|InstituicaoEndereco withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoEndereco whereDeletedAt($value)
 */
class InstituicaoEndereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public static function newFactory(): Factory
    {
        return InstituicaoEnderecoFactory::new();
    }
}
