<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Funcionalidade
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Perfil[] $perfils
 * @property-read int|null $perfils_count
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nome
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Funcionalidade whereUpdatedAt($value)
 */
class Funcionalidade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function perfils()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_funcionalidades');
    }
}
