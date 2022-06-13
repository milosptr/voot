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
        'rautt', 'rauður', 'rauÐur', 'grænt', 'grænn', 'grÆnn', 'dökkgrænn', 'svart', 'svartur', 'gult', 'gulur', 'dökkblátt', 'blátt', 'blár', 'blÁr', 'grátt', 'grár', 'dökkgrátt', 'hvÍtur', 'hvítur', 'hvítt', 'brúnn', 'brúnt', 'appelsínugult', 'appelsínugulur', 'appelsÍnugulur',
        'bleikur', 'bleikt'
      ];
      foreach($variants as $v) {
        if(in_array($v, $colors))
        $color = $v;
      }

      return [ 'original' => $color, 'name' => ProductVariation::translateVariation($color), 'hex' => ProductVariation::getVariationHex($color)];
    }

    public static function getVariationHex($c)
    {
      $color = ProductVariation::translateVariation($c);

      $mapper = [
        'red' => '#e53000',
        'pink' => '#ff8da1',
        'green' => '#009700',
        'green-dark' => '#2d3c2f',
        'black' => '#111',
        'yellow' => '#fed100',
        'blue-dark' => '#1d3e78',
        'blue' => '#136dba',
        'gray-dark' => '#7b7b7b',
        'gray' => '#c3c3c3',
        'white' => '#fff',
        'brown' => '#731d1d',
        'orange-dark' => '#c1571d',
        'orange' => '#ee743c',
      ];

      return isset($mapper[$color]) ? $mapper[$color] : $color;
    }

    public static function translateVariation($v)
    {
      $mapper = [
        'rautt' => 'red',
        'rauður' => 'red',
        'rauÐur' => 'red',
        'bleikur' => 'pink',
        'bleikt' => 'pink',
        'grænt' => 'green',
        'grænn' => 'green',
        'dökkgrænn' => 'green-dark',
        'grÆnn' => 'green-dark',
        'svart' => 'black',
        'svartur' => 'black',
        'gult' => 'yellow',
        'gulur' => 'yellow',
        'dökkblátt' => 'blue-dark',
        'blátt' => 'blue',
        'blár' => 'blue',
        'blÁr' => 'blue',
        'grátt' => 'gray',
        'grár' => 'gray',
        'dökkgrátt' => 'gray-dark',
        'hvítur' => 'white',
        'hvÍtur' => 'white',
        'hvítt' => 'white',
        'brúnn' => 'brown',
        'brúnt' => 'brown',
        'appelsínugult' => 'orange-dark',
        'appelsínugulur' => 'orange-dark',
        'appelsÍnugulur' => 'orange-dark',
      ];

      return isset($mapper[$v]) ? $mapper[$v] : $v;
    }
}
