<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductIcon extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'settings_icons_id'];
    public $timestamps = true;

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
