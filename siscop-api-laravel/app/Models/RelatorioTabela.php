<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\RelatorioTabela
 *
 * @property int $id
 * @property int $relatorio_id
 * @property int $tabela_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela query()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela whereRelatorioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela whereTabelaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatorioTabela whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Relatorio $relatorio
 * @property-read \App\Models\Tabela $tabela
 */
class RelatorioTabela extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function relatorio(): BelongsTo
    {
        return $this->belongsTo(Relatorio::class, 'relatorio_id');
    }

    /**
     * @return BelongsTo
     */
    public function tabela(): BelongsTo
    {
        return $this->belongsTo(Tabela::class, 'tabela_id');
    }
}
