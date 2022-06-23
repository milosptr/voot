<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];
    public $timestamps = true;

    public static function getHomepageProducts() {
      $hpconfig = Config::where('key', 'homepage_products')->get()->first();
      $ids = isset($hpconfig) ? json_decode($hpconfig->value) : [];
      return Product::whereIn('id', $ids)->get();
    }
}
