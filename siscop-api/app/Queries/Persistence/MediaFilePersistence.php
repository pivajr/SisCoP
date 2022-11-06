<?php

namespace App\Queries\Persistence;

use App\Models\MediaFile;
use App\Queries\Base\Persistence;
use Exception;
use Illuminate\Http\UploadedFile;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<MediaFile>
 */
class MediaFilePersistence extends Persistence
{
    private $file;
    private string $disk = 'local';

    public function __construct(array $data, $obj, $file, string $disk = 'local')
    {
        $this->disk = $disk;
        $this->file = $file;
        parent::__construct($data, $obj);
    }

    /**
     * @return void
     * @throws \Throwable
     */
    public function fieldsOnce(): void
    {
        throw_if(!$this->file->isValid(), new Exception('Arquivo informado é inválido'));

        $extension = strtolower($this->file->getClientOriginalExtension());
        $filename = hash('crc32b', now()->format('ymd').$this->file->getClientOriginalName()).'.'.$extension;
        $mimeType = $this->file->getMimeType();
        $size = $this->file->getSize();

        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            $path = 'media_files/images/'.date('Y/m');
        } else {
            $path = 'media_files/files/'.date('Y/m');
        }

        $this->file->storeAs($path, $filename, $this->disk);

        $this->obj->path = $path;
        $this->obj->filename = $filename;
        $this->obj->extension = $extension;
        $this->obj->mimeType = $mimeType;
        $this->obj->size = $size;
    }

    /**
     * @param bool $isUpdate
     * @return void
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        // TODO: Implement fieldsUpdatable() method.
    }

    /**
     * @param bool $isUpdate
     * @return void
     */
    public function relations(bool $isUpdate): void
    {
        // TODO: Implement relations() method.
    }
}
