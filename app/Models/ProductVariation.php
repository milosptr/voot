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
      $colors = [
        'red', 'green', 'dark green', 'black', 'yellow', 'dark blue ', 'blue', 'gray', 'dark gray', 'white', 'White', 'brown', 'orange',
        'rautt', 'rauður', 'grænt', 'grænn', 'dökkgrænn', 'svart', 'svartur', 'gult', 'gulur', 'dökkblátt', 'blátt', 'blár', 'grátt', 'grár', 'dökkgrátt', 'hvítur', 'hvítt', 'brúnn', 'brúnt', 'appelsínugult', 'appelsínugulur'
      ];
      foreach($variants as $v) {
        if(in_array($v, $colors))
          $color = $v;
      }
      return [ 'original' => $color, 'name' => ProductVariation::translateVariation($color)];
    }

    public static function translateVariation($v)
    {
      $mapper = [
        'rautt' => 'red',
        'rauður' => 'red',
        'grænt' => 'green',
        'grænn' => 'green',
        'dökkgrænn' => 'green-dark',
        'svart' => 'black',
        'svartur' => 'black',
        'gult' => 'yellow',
        'gulur' => 'yellow',
        'dökkblátt' => 'blue-dark',
        'blátt' => 'blue',
        'blár' => 'blue',
        'grátt' => 'gray',
        'grár' => 'gray',
        'dökkgrátt' => 'gray-dark',
        'hvítur' => 'white',
        'hvítt' => 'white',
        'brúnn' => 'brown',
        'brúnt' => 'brown',
        'appelsínugult' => 'brown',
        'appelsínugulur' => 'brown',
      ];

      return isset($mapper[$v]) ? $mapper[$v] : $v;
    }
}
