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
          'parent_id' => $this->parent_id,
          'parent' => $this->parent(),
          'children' => $this->tree,
          'order' => $this->order,
          'available' => $this->available,
      ];
  }
}
