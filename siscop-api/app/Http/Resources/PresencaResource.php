<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PresencaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'user_id' => $this->user_id,
            'turma_id' => $this->turma_id,
            'instituicao_id' => $this->instituicao_id,
            'data_presenca' => $this->data_presenca->format('Y-m-d H:i:s'),
            'user' => $this->user
        ];
    }
}
