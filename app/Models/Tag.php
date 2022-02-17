<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'slug'];
    public $timestamps = true;

    public function products()
    {
      return $this->belongsToMany('App\Models\Product', 'product_tags', 'tag_id', 'product_id');
    }
}
