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
        'label' => $this->label,
        'sku' => $this->sku,
        'quantity' => $this->quantity,
        'quantity_name' => $this->quantity_name,
        'quantity_translated' => (int) $this->quantityNameTranslated,
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
        'duplicates' => $this->duplicatedSKUS
      ];
    }
}
