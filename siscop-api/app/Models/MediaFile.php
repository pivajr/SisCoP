<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\MediaFile
 *
 * @property-read string $full_path
 * @property-read string $link
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile newQuery()
 * @method static \Illuminate\Database\Query\Builder|MediaFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile query()
 * @method static \Illuminate\Database\Query\Builder|MediaFile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MediaFile withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $path
 * @property string $extension
 * @property string $filename
 * @property string $mimeType
 * @property int $size
 * @property string $disk
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaFile whereUpdatedAt($value)
 */
class MediaFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $appends = ['link'];

    public function getFullPathAttribute(): string
    {
        return $this->path.'/'.$this->filename;
    }

    public function getLinkAttribute(): string
    {
        return asset(Storage::url($this->path.'/'.$this->filename));
    }

    public function delete()
    {
        info('>> destruindo arquivo '.$this->id);

        if (Storage::disk($this->disk)->exists($this->full_path)) {
            Storage::disk($this->disk)->delete($this->full_path);
        } else {
            info('>> arquivo não encontrado '.$this->full_path);
        }

        parent::delete();
    }
}
