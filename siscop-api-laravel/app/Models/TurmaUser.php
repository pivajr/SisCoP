<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TurmaUser
 *
 * @property-read \App\Models\Turma|null $turma
 * @property-read \App\Models\User|null $users
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $turma_id
 * @property int $user_id
 * @property int $instituicao_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereInstituicaoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereTurmaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TurmaUser whereUserId($value)
 */
class TurmaUser extends Model
{
    use HasFactory;

    protected $table = 'turma_users';
    protected $guarded = ['id'];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
