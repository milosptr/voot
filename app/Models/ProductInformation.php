<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInformation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['product_id', 'name', 'value'];

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
