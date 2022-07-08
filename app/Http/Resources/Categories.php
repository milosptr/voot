<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Categories extends JsonResource
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
          'slug' => $this->slug,
          'parent_id' => (int) $this->parent_id,
          'order' => (int) $this->order,
          'available' => $this->available,
          'children' => isset($this->children) ? $this->children : $this->tree(),
          'total_products' => count($this->products),
          'featured_image' => $this->image,
      ];
  }
}
