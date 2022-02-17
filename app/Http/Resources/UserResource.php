<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'ssn' => $this->ssn,
          'name' => $this->name,
          'email' => $this->email,
          'street' => $this->street,
          'zip' => $this->zip,
          'city' => $this->city,
          'country' => $this->country,
          'phone' => $this->phone,
        ];
    }
}
