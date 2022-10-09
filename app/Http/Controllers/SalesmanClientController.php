<?php

namespace App\Http\Controllers;

use App\Models\SalesmanClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesmanClientController extends Controller
{
    public function forSalesman()
    {
      $clients = SalesmanClient::where('salesman_id', auth()->user()->id)->pluck('client_id');
      $customers = User::where('role', 'customer')->get();

      return [
        'customers' => $customers,
        'clients' => $clients
      ];
    }

    public function store(Request $request)
    {
      $user = User::find(auth()->user()->id);
      $data = array_map(function ($client) {
        return [
          'salesman_id' => auth()->user()->id,
          'client_id' => $client,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ];
      }, $request->all());

      $user->clients()->delete();
      return SalesmanClient::insert($data);
    }
}
