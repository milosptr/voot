<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function checkSku($sku)
    {
      return ['status' => !!Inventory::where('sku', $sku)->count()];
    }
}
