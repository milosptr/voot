<?php

namespace App\Models;

use App\Traits\AssetsUploadTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory, AssetsUploadTrait;

    protected $fillable = [
      'name',
      'file_path',
      'product_id',
      'category_id',
      'featured_image',
  ];
}
