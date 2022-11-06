<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Parametro
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $codigo
 * @property string $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parametro whereValor($value)
 */
class Parametro extends Model
{
    use HasFactory;
    protected $table = 'parametros';
    protected $guarded = ['id'];
}
