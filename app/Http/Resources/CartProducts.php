<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartProducts extends JsonResource
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
        'name' => $this->name,
        'description' => $this->description,
        'sku' => $this->sku,
        'slug' => $this->slug,
        'categories' => $this->categories,
        'media' => $this->media,
        'featured_image' => $this->featured_image,
      ];
    }
}
