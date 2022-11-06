<?php

namespace App\Models;

use Database\Factories\InstituicaoUserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InstituicaoUser
 *
 * @property-read \App\Models\Instituicao|null $instituicao
 * @property-read \App\Models\Perfil|null $perfil
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\InstituicaoUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $instituicao_id
 * @property int $user_id
 * @property int $perfil_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser wherePerfilId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InstituicaoUser whereUserId($value)
 */
class InstituicaoUser extends Model
{
    use HasFactory;

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    public static function newFactory(): Factory
    {
        return InstituicaoUserFactory::new();
    }
}
