<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RelatorioColuna
 *
 * @property int $id
 * @property int $relatorio_id
 * @property string $nome
 * @property string $alias
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereRelatorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $coluna_id
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioColuna whereColunaId($value)
 * @property-read \App\Models\TabelaColuna $coluna
 */
class RelatorioColuna extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function coluna(): BelongsTo
    {
        return $this->belongsTo(TabelaColuna::class, 'coluna_id');
    }
}
