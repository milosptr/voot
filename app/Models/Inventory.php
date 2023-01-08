<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'sku', 'name'];
    protected $guarded = ['id'];
    protected $table = 'inventory';
    public $timestamp = true;

    public function product()
    {
      return $this->belongsTo('App\Models\Product');
    }

}
