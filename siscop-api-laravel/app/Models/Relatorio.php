<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Relatorio
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nome
 * @property string $slug
 * @property string $nome_arquivo
 * @property string $view
 * @property string|null $orientacao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereNomeArquivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereOrientacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Relatorio whereView($value)
 * @property-read int|null $colunas_count
 * @property-read int|null $parametros_count
 * @property-read int|null $tabelas_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RelatorioColuna[] $colunas
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RelatorioParametro[] $parametros
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RelatorioTabela[] $tabelas
 */
class Relatorio extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function tabelas(): HasMany
    {
        return $this->hasMany(RelatorioTabela::class, 'relatorio_id');
    }

    /**
     * @return HasMany
     */
    public function parametros(): HasMany
    {
        return $this->hasMany(RelatorioParametro::class, 'relatorio_id');
    }

    /**
     * @return HasMany
     */
    public function colunas(): HasMany
    {
        return $this->hasMany(RelatorioColuna::class, 'relatorio_id');
    }
}
