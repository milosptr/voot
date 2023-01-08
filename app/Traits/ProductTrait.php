<?php
namespace App\Traits;

use stdClass;
use App\Models\Order;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\ProductVariation;
use Exception;
use Illuminate\Support\Facades\Log;

trait ProductTrait {
  /**
  * @param Inventory $inventory
  * @param ProductVariation $variant
  * @return string
  */
  public static function getProductName($inventory, $variant)
  {
    try {
      if(isset($inventory) && isset($inventory->name))
      return $inventory->name;
      if(isset($variant) && isset($variant->product))
        return $variant->product->name;
      return '';
    } catch(Exception $e) {
      Log::error('ProductTrait::getProductName error: '. $e->getMessage());
      return '';
    }
  }

  /**
  * @param Product $inventory
  * @param ProductVariation $variant
  * @return int
  */
  public static function getProductID($product, $variant)
  {
    try {
      if(isset($variant) && isset($variant->product_id))
        return $variant->product_id;
      if(isset($product))
        return $product->id;
      return 0;
    } catch(Exception $e) {
      Log::error('ProductTrait::getProductID error: '. $e->getMessage());
      return 0;
    }
  }

  /**
  * @param Product $inventory
  * @param ProductVariation $variant
  * @return string
  */
  public static function getProductPrimaryCategoryName($product, $variant)
  {
    try {
      if(isset($variant) && isset($variant->product))
        $productModel = $variant->product;
      if(isset($product) && count($product->primaryCategories))
        $productModel = $product;
      if(isset($productModel) && count($productModel->primaryCategories))
        return $productModel->primaryCategories->first()->name;
      return 'Uncategorised';
    } catch(Exception $e) {
      Log::error('ProductTrait::getProductPrimaryCategoryName error: '. $e->getMessage());
      return 'Uncategorised';
    }
  }

  /**
  * @param Order $order
  * @return array of grouped products by category
  */
  public static function parseSortedProductsByCategory($order)
  {
    $products = array();
    $categories = array();

    foreach($order->order as $order) {
      try {
        $singleProduct = new stdClass;
        $inventory = Inventory::where('sku', $order['sku'])->first();
        $variant = ProductVariation::where('sku', $order['sku'])->first();
        $product = isset($inventory) && $inventory->product_id ? $inventory->product : Product::where('sku', $order['sku'])->first();

        $singleProduct->category = self::getProductPrimaryCategoryName($product, $variant);
        $singleProduct->name = self::getProductName($inventory, $variant);
        $singleProduct->product_id = self::getProductID($product, $variant);
        $singleProduct->qty = $order['qty'];
        $singleProduct->sku = $order['sku'];
        $singleProduct->slug = isset($product) ? $product->slug : '';
        array_push($products, $singleProduct);
      } catch (Exception $e) {
        Log::error('ProductTrait::parseSortedProductsByCategory foreach order error: '.$e->getMessage());
        continue;
      }
    }
    foreach ($products as $product){
      if (!array_key_exists($product->category , $categories))
        $categories[$product->category] = array();
      $categories[$product->category][] = $product;
    }

    return $categories;
  }
}
