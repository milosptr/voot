<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Products as ResourcesProducts;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['title', 'content', 'products'];
    public $timestamps = true;

    public function getListProductsAttribute()
    {
      return ResourcesProducts::collection(Product::whereIn('id', json_decode($this->products))->get());
    }
}
