<?php

namespace App\Models;

use App\Models\ActivityLog;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public static function search($search = null, $html = false)
    {
      if (!$search) {
        $customers = User::where('role', 'customer')->orderBy('name')->get();
        return view('components.customer.list', compact('customers'));
      }

      $customers = User::where(function($q) use($search) {
        $q->where('name', 'LIKE', '%'.$search."%")
        ->orWhere('phone', 'LIKE', '%'.$search.'%')
        ->orWhere('key', 'LIKE', '%'.$search.'%');
      })
      ->where('role', 'customer')
      ->orderBy('id', 'DESC')
      ->get();

        if($html)
          return view('components.customer.list', compact('customers'));
        return $customers;
    }

    public static function resetPassword()
    {
      $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
      $password = substr($random, 0, 10);

      return $password;
    }
}
