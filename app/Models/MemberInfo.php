<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberInfo extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'members_info';
    protected $guarded = ['id'];
    protected $fillable = [
      'user_id',
      'name',
      'shoe_size',
      'glove_size',
      'hat_size',
      'headset_size',
      'jacket_size',
      'vest_size',
      'suit_size',
      'pants_size',
      'shirt_size',
    ];
}
