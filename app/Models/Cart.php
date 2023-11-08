<?php

namespace App\Models;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory, HasUUID;

    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'sku', 'quantity', 'comment', 'subaccount_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subaccount()
    {
        return $this->belongsTo(User::class, 'subaccount_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public static function cartNumber($user_id, $subaccount)
    {
        $user = User::find($user_id);
        $subaccount = $user::find($subaccount);

        if ($subaccount) {
            $cart = Cart::where('user_id', $user_id)
                        ->where('subaccount_id', $subaccount->id)
                        ->get();
        } else {
            $cart = Cart::where('user_id', $user_id)->whereNull('subaccount_id')->get();
        }

        return $cart->count();
    }
}
