<?php

namespace App\Models;

use Database\Factories\InstituicaoStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InstituicaoStatus
 *
 * @method static \Database\Factories\InstituicaoStatusFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $nome
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoStatus whereUpdatedAt($value)
 */
class InstituicaoStatus extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'slug'];
    protected $table = 'instituicao_status';

    public static function newFactory()
    {
        return InstituicaoStatusFactory::new();
    }
}
