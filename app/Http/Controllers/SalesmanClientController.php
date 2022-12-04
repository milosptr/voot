<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SalesmanClient;

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
      try {
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
        SalesmanClient::insert($data);
        return response('Client list is successfuly saved!', 200);
    } catch (Exception $e) {
      return response('Something went wrong, please try again!', 422);
    }
  }
}
