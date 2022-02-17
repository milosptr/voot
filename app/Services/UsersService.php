<?php
namespace App\Services;

use App\Models\User;

class UsersService {

  public static function usersWithOrders()
  {
    return User::where('role', 'customer')->whereHas('orders')->get();
  }
}
