<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['user_id', 'order_id', 'product_id', 'from', 'to'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function order()
    {
      return $this->belongsToMany(Order::class);
    }
}
