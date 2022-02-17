<?php

namespace App\Http\Controllers;

use App\Models\ProductAssets as ModelsProductAssets;
use Illuminate\Http\Request;

class ProductAssets extends Controller
{
    public function destroy($id)
    {
      $pa = ModelsProductAssets::find($id);
      return $pa->delete();
    }
}
