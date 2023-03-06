<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesWithChildren extends JsonResource
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
            'children' => Category::where('parent_id', $this->id)->get(),
            'total_products' => count($this->products),
            'featured_image' => $this->image,
        ];
    }
}
