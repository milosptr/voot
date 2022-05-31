<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
      return Config::all();
    }

    public function update(Request $request)
    {
      foreach ($request->all() as $c) {
        $config = Config::find($c['id']);
        $config->update($c);
      }
      return Config::all();
    }
}
