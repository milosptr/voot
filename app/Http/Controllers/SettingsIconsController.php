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
        if(!empty($icon['name']))
          SettingsIcon::create($icon);
      }
      return SettingsIcon::all();
    }
}
