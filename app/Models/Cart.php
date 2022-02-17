<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'cart'];
    public $timestamps = true;

    public $cast = [
      'cart' => 'json',
    ];


    public static function cartNumber($id) {
      $cart =  Cart::where('user_id', $id)->first();
      if($cart)
        return count(json_decode($cart->cart));
      return 0;
    }

}
