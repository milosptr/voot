<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    CONST STATUS_REQUESTED = 0;
    CONST STATUS_ACCEPTED = 1;
    CONST STATUS_IN_PROGRESS = 2;
    CONST STATUS_DELIVERY = 3;
    CONST STATUS_DONE = 4;

    CONST DELIVERY = 1;
    CONST PICKUP = 2;

    protected $guarded = ['id'];
    protected $fillable = [
      'user_id',
      'order_id',
      'order_status',
      'order',
      'shipping_method',
      'shipping_address',
      'shipping_date',
      'pickup_location',
      'note'
    ];
    public $timestamps = true;

    protected $casts = [
      'order' => 'json',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function orderAddress()
    {
      if($this->shipping_method === self::DELIVERY)
        return $this->shipping_address;
      return Location::find($this->pickup_location)->fullAddress();
    }



    public static function statusText($status)
    {
      $mapper = [
        0 => 'Requested',
        1 => 'Accepted',
        2 => 'In progress',
        3 => 'On delivery',
        4 => 'Done',
      ];
      return $status ? $mapper[$status] : 'Requested';
    }

    public static function statusClasses($status)
    {
      $classes = 'text-center mt-1 inline-block shadow-sm text-sm sm:text-xs py-2 px-4 rounded-md uppercase font-bold tracking-wide';
      $mapper = [
        0 => 'bg-gray-200 text-gray-500 border-1 border-gray-200',
        1 => 'bg-blue-200 text-primary-lighter border-1 border-blue-200',
        2 => 'bg-orange-200 text-orange-400 border-1 border-orange-200',
        3 => 'bg-sky-200 text-sky-600 border-1 border-sky-200',
        4 => 'bg-emerald-200 text-emerald-600 border-1 border-emerald-200',
      ];
      return $status !== null ? ($classes . ' ' . $mapper[$status]) : $classes;
    }
}
