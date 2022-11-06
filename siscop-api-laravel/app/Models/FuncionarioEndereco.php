<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FuncionarioEndereco
 *
 * @package App\Models
 * @method static \Database\Factories\FuncionarioEnderecoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco newQuery()
 * @method static \Illuminate\Database\Query\Builder|FuncionarioEndereco onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco query()
 * @method static \Illuminate\Database\Query\Builder|FuncionarioEndereco withTrashed()
 * @method static \Illuminate\Database\Query\Builder|FuncionarioEndereco withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property int $funcionario_id
 * @property string $cep
 * @property string $uf
 * @property string $cidade
 * @property string $bairro
 * @property string $rua
 * @property string $numero
 * @property string|null $complemento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereComplemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereFuncionarioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereRua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FuncionarioEndereco whereUpdatedAt($value)
 */
class FuncionarioEndereco extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['funcionario_id', 'cep', 'uf', 'cidade', 'bairro', 'rua', 'numero', 'complemento'];
}
