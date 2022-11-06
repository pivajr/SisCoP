<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Database\Factories\PresencaFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Presenca
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $turma_id
 * @property int $instituicao_id
 * @property string $data_presenca
 * @property double $latitude
 * @property double $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static PresencaFactory factory(...$parameters)
 * @method static Builder|Presenca newModelQuery()
 * @method static Builder|Presenca newQuery()
 * @method static Builder|Presenca query()
 * @method static Builder|Presenca whereCreatedAt($value)
 * @method static Builder|Presenca whereDataPresenca($value)
 * @method static Builder|Presenca whereId($value)
 * @method static Builder|Presenca whereInstituicaoId($value)
 * @method static Builder|Presenca whereTurmaId($value)
 * @method static Builder|Presenca whereUpdatedAt($value)
 * @method static Builder|Presenca whereUserId($value)
 * @mixin Eloquent
 * @property-read \App\Models\Instituicao|null $instituicao
 * @property-read \App\Models\Turma|null $turma
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Query\Builder|Presenca onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Presenca withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Presenca withoutTrashed()
 * @property Carbon|null $deleted_at
 * @property int|null $imagem_id
 * @method static Builder|Presenca whereDeletedAt($value)
 * @method static Builder|Presenca whereImagemId($value)
 * @method static Builder|Presenca whereLatitude($value)
 * @method static Builder|Presenca whereLongitude($value)
 */
class Presenca extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'data_presenca' => 'date:Y-m-d H:i:s',
        'latitude' => 'double',
        'longitude' => 'double',
        'user_id' => 'integer',
        'turma_id' => 'integer',
        'instituicao_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'turma_id');
    }

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public static function newFactory(): Factory
    {
        return PresencaFactory::new();
    }

    /**
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
