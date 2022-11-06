<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Perfil
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Funcionalidade[] $funcionalidades
 * @property-read int|null $funcionalidades_count
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nome
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Perfil whereUpdatedAt($value)
 */
class Perfil extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function funcionalidades(): BelongsToMany
    {
        return $this->belongsToMany(Funcionalidade::class, 'perfil_funcionalidades');
    }
}
