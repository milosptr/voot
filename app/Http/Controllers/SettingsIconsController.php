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
        $iconStatus = SettingsIcon::where('name', $icon['name'])->get();
        if(!empty($icon['name']) && !isset($iconStatus))
          SettingsIcon::create($icon);
      }
      return SettingsIcon::all();
    }
}
