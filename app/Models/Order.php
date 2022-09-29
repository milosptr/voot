<?php

namespace App\Models;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    CONST STATUS_REQUESTED = 0;
    CONST STATUS_ACCEPTED = 1;
    CONST STATUS_IN_PROGRESS = 2;
    CONST STATUS_DELIVERY = 3;
    CONST STATUS_DONE = 4;
    CONST STATUS_PENDING = 5;

    CONST AX_STATUS_SAVED = 1;
    CONST AX_STATUS_FAILED = 0;

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
      'note',
      'ax_status',
      'customer_key',
    ];
    public $timestamps = true;

    protected $casts = [
      'order' => 'json',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function activityLog()
    {
      return $this->hasMany(ActivityLog::class);
    }

    public function orderAddress()
    {
      if($this->shipping_method == self::DELIVERY)
        return $this->shipping_address;
      return Location::find($this->pickup_location)->fullAddress();
    }

    public function getProducts()
    {
      $skus = array_column($this->order, 'sku');
      $product_ids = ProductVariation::whereIn('product_variations.sku', $skus)->pluck('product_id');
      return Product::whereIn('products.id', $product_ids)
                ->select('products.*', 'inventory.name as full_name', 'product_variations.sku as sku')
                ->join('product_variations', function($q) use($skus) {
                  $q->on('product_variations.product_id', '=', 'products.id')
                    ->whereIn('product_variations.sku', $skus);
                  })
                  ->leftJoin('inventory', function($q) {
                    $q->on('product_variations.sku', '=', 'inventory.sku');
                })
                ->with('media')
                ->get();
    }

    public static function statusText($status)
    {
      $mapper = self::statuses();
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
        5 => 'bg-orange-200 text-orange-400 border-1 border-orange-200',
      ];
      return $status !== null ? ($classes . ' ' . $mapper[$status]) : $classes;
    }

    public static function slugifyStatus($status)
    {
      $statuses = [
        0 => 'requested',
        1 => 'accepted',
        2 => 'in-progress',
        3 => 'on-delivery',
        4 => 'done',
        5 => 'pending',
      ];
      return $statuses[$status];
    }

    public static function statuses()
    {
      return [
        0 => 'Requested',
        1 => 'Accepted',
        2 => 'In progress',
        3 => 'On delivery',
        4 => 'Done',
        5 => 'Pending',
      ];
    }
}
