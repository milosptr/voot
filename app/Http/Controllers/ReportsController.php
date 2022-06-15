<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function orders()
    {
      return Order::selectRaw('count(*) as total, DATE_FORMAT(created_at, "%Y-%m-%d") as created_at_date')
      ->groupBy('created_at_date')
      ->get();

      // $data = [];
      // foreach()
    }

    public function create_array($num_elements){
      return array_fill(0, $num_elements, [ "total" => rand(5,100), "created_at_date" => '2022-10-10']);
  }
}
