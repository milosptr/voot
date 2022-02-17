<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['product_id', 'name', 'file_path'];
    public $timestamps = true;


    public function getDocumentNameAttribute()
    {
      $name = explode('--', $this->file_path)[1];
      $name = str_replace('-', ' ', $name);
      $name = str_replace('_', ' ', $name);
      $name = str_replace('.pdf', ' ', $name);
      return $name;
    }
}
