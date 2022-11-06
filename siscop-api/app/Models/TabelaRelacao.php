<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TabelaRelacao
 *
 * @property int $id
 * @property int $tabela_pai_id
 * @property int $tabela_rel_id
 * @property string $tabela_pai_alias
 * @property string $tabela_rel_alias
 * @property string $tabela_pai_fk
 * @property string $tabela_rel_fk
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $tabela_pivot_id
 * @property string|null $tabela_pivot_alias
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao query()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPaiAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPaiFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPaiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPivotAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPivotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaRelAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaRelFk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaRelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $tabela_pivot_fk
 * @property-read \App\Models\Tabela $tabelaPai
 * @property-read \App\Models\Tabela $tabelaRelacao
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaRelacao whereTabelaPivotFk($value)
 * @property-read \App\Models\Tabela|null $tabelaPivot
 */
class TabelaRelacao extends Model
{
    use HasFactory;
    protected $table = 'tabela_relacoes';
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function tabelaPai(): BelongsTo
    {
        return $this->belongsTo(Tabela::class, 'tabela_pai_id');
    }

    /**
     * @return BelongsTo
     */
    public function tabelaRelacao(): BelongsTo
    {
        return $this->belongsTo(Tabela::class, 'tabela_rel_id');
    }

    /**
     * @return BelongsTo
     */
    public function tabelaPivot(): BelongsTo
    {
        return $this->belongsTo(Tabela::class, 'tabela_pivot_id');
    }
}
