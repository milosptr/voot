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
        'species' => $this->species,
        'sku' => $this->sku,
        'quantity' => $this->quantity,
        'price' => $this->price,
        'available' => $this->available,
        'categories' => $this->categories,
        'media' => $this->media,
        'featured_image' => $this->featured_image,
        'documents' => $this->documents,
        'tags' => $this->tags,
        'informations' => $this->information,
        'icons' => $this->icons,
        'variations' => $this->variations,
        'product_table' => $this->product_table,
        'url' => $this->productUrl,
      ];
    }
}
