<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    CONST TYPE_CUSTOMER = 1;
    CONST TYPE_SALESMAN = 2;

    public $timestamps = true;
    protected $fillable = ['remark', 'to', 'class', 'order_id', 'sent_at', 'type'];

    public function order()
    {
      return $this->belongsTo(Order::class);
    }
}
