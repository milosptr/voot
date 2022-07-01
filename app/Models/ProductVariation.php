<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'option', 'value', 'name', 'sku', 'quantity', 'file_path'];

    protected $table = 'product_variations';

    public function products()
    {
      return $this->belongsToMany('App\Models\Product');
    }

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

    public static function getVariantColor($variant)
    {
      $variants = explode('/', strtolower($variant['value']));
      $color = false;

      foreach($variants as $v) {
        $c = Color::where('name', $v)->orWhere('name_en', $v)->get();
        if(count($c))
          $color = $c->first();
      }

      return [ 'original' => $color->name, 'name' => $color->name_en, 'hex' => $color->hex];
    }
}
