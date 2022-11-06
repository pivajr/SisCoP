<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RelatorioParametro
 *
 * @property int $id
 * @property int $relatorio_id
 * @property string $nome
 * @property string $coluna
 * @property string $alias
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereColuna($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereRelatorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioParametro whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RelatorioParametro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
