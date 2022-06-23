<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function indexAll()
    {
      return Config::all();
    }

    public function index($key)
    {
      return Config::where('key', $key)->get();
    }

    public function updateOrStore(Request $request)
    {
      if(!$request->get('id')) {
        return Config::create($request->all());
      }
      $config = Config::find($request->get('id'));
      return $config->update($request->all());
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
