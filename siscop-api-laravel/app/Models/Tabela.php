<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Tabela
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property int $selecionavel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereSelecionavel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TabelaColuna[] $colunas
 * @property-read int|null $colunas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TabelaRelacao[] $relacoes
 * @property-read int|null $relacoes_count
 * @property string|null $alias
 * @method static \Illuminate\Database\Eloquent\Builder|Tabela whereAlias($value)
 */
class Tabela extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * @return HasMany
     */
    public function colunas(): HasMany
    {
        return $this->hasMany(TabelaColuna::class, 'tabela_id');
    }

    public function relacoes(): HasMany
    {
        return $this->hasMany(TabelaRelacao::class, 'tabela_pai_id');
    }
}
