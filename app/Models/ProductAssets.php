<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAssets extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'asset_id'];

    protected $table = 'product_assets';
    public $timestamps = false;
}
