<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductInformation as ResourcesProductInformation;
use App\Models\ProductInformation;
use Illuminate\Http\Request;

class ProductInformationController extends Controller
{
  public function index($productId)
  {
    $information = ProductInformation::where('product_id', $productId)->get();
    return ResourcesProductInformation::collection($information);
  }
}
