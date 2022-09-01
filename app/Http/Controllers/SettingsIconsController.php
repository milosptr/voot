<?php

namespace App\Http\Controllers;

use App\Models\SettingsIcon;
use Illuminate\Http\Request;

class SettingsIconsController extends Controller
{
    public function index()
    {
      return SettingsIcon::all();
    }

    public function store(Request $request)
    {
      foreach ($request->all() as $icon) {
        if(!empty($icon['name']) && $icon['id'] === 0) {
          SettingsIcon::create($icon);
        }
      }
      return SettingsIcon::all();
    }

    public function destroy($id)
    {
      $icon = SettingsIcon::find($id);
      return $icon->delete();
    }
}
