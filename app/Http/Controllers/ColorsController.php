<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorsController extends Controller
{
    public function all()
    {
      return Color::all();
    }

    public function store(Request $request)
    {
      foreach($request->all() as $c) {
        if($c['id']) {
          $color = Color::find($c['id']);
          $color->update($c);
        } else {
          Color::create($c);
        }
      }

      return Color::all();
    }

    public function destroy($id)
    {
      $color = Color::find($id);
      if($color)
        $color->delete();
      return Color::all();
    }
}
