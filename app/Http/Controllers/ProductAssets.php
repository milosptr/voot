<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\ProductAssets as ProductAssetsModel;

class ProductAssets extends Controller
{
    public function destroy($id)
    {
      $asset = Asset::find($id);
      ProductAssetsModel::where('asset_id', $id)->delete();
      return $asset->delete();
    }
}
