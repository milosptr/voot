<?php

namespace App\Models;

use Exception;
use App\Models\ActivityLog;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Products;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'invoice_email',
        'password',
        'key',
        'ssn',
        'street',
        'city',
        'zip',
        'country',
        'phone',
        'logo',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
      return $this->role === 'admin';
    }

    public function cart()
    {
      return $this->hasOne(Cart::class);
    }

    public function orders()
    {
      return $this->hasMany(Order::class);
    }

    public function activityLogs()
    {
      return $this->hasMany(ActivityLog::class);
    }

    public function favourites()
    {
      return $this->belongsToMany(Product::class, 'product_favourites')->orderByPivot('id', 'DESC');
    }

    public function clients()
    {
      return $this->hasMany(SalesmanClient::class, 'salesman_id');
    }

    public function salesman()
    {
      return $this->hasMany(SalesmanClient::class, 'client_id')
        ->leftJoin('users', 'users.id', '=', 'salesman_clients.salesman_id');
    }

    public static function search($search = null, $html = false)
    {
      if (!$search) {
        $customers = User::where('role', 'customer')->orderBy('name')->paginate();
        return view('components.customer.list', compact('customers'));
      }

      $customers = User::where(function($q) use($search) {
        $q->where('name', 'LIKE', '%'.$search."%")
        ->orWhere('phone', 'LIKE', '%'.$search.'%')
        ->orWhere('key', 'LIKE', '%'.$search.'%');
      })
      ->where('role', 'customer')
      ->orderBy('id', 'DESC')
      ->paginate();

        if($html)
          return view('components.customer.list', compact('customers'));
        return $customers;
    }

    public function getCompaniesAttribute()
    {
      return User::where('ssn', $this->ssn)->get();
    }

    public function getCustomerShippingAddress()
    {
      $street = $this->street ? ($this->street . ', ') : '';
      $city =  ($this->city && $this->zip) ? ($this->city . ' ' . $this->zip . ', ') : '';
      $country = $this->country;
      return $street.$city.$country;
    }

    public function getCartItems()
    {
      $filteredCart = json_decode($this->cart->cart, true);
      $products = array();
      foreach($filteredCart as $item) {
        try {
          $inventory = Inventory::where('sku', $item['sku'])->first();
          $product = Product::where('sku', $item['sku'])->first();
          $pv = ProductVariation::where('sku', $item['sku'])->first();
          if(!$product && !isset($pv) && !isset($pv->product_id))
            continue;
          if(!$product)
            $product = Product::find($pv->product_id);
          $product->name = isset($inventory->name) ? $inventory->name : $product->name;
          array_push($products, Products::transformProductForCheckout($product, $item['qty']));
        } catch(Exception $e) {
          Log::error('User::getCartItems' . $e->getMessage());
          continue;
        }
      }
      return $products;
    }

    public static function resetPassword()
    {
      $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
      $password = substr($random, 0, 10);

      return $password;
    }
}
