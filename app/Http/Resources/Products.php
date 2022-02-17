<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Products extends JsonResource
{

  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
      return [
        'id' => $this->id,
        'name' => $this->name,
        'description' => $this->description,
        'sku' => $this->sku,
        'quantity' => $this->quantity,
        'price' => $this->price,
        'available' => $this->available,
        'categories' => $this->categories,
        'media' => $this->media,
        'featured_image' => $this->featured_image,
      ];
    }
}
