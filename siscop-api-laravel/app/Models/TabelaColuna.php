<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TabelaColuna
 *
 * @property int $id
 * @property int $tabela_id
 * @property string $nome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna query()
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna whereTabelaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TabelaColuna whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TabelaColuna extends Model
{
    use HasFactory;
}
