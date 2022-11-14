<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use App\Models\Color;
use App\Models\Product;
use App\Models\Document;
use App\Models\Inventory;
use App\Models\ProductTag;
use Cocur\Slugify\Slugify;
use App\Models\ProductIcon;
use Illuminate\Http\Request;
use App\Models\ProductAssets;
use App\Models\ProductFavourite;
use App\Models\ProductVariation;
use App\Models\ProductCategories;
use App\Models\ProductInformation;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\CartProducts;
use App\Http\Resources\ProductAsset;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductWithCategories;
use App\Http\Resources\Products as ResourcesProducts;

class Products extends Controller
{
    public function search(Request $request)
    {

      $query = Product::query();

      if ($request->has('category')) {
        $category = $request->get('category');
        $query->select('products.*');
        $query->leftJoin('product_categories', function ($q) use ($category) {
            $q->on('products.id', '=', 'product_categories.product_id');
        })->where('product_categories.category_id', $category);
      }

      if($request->has('s')) {
        $query->whereLike(['name', 'sku', 'english_name'], $request->get('s'));
      }

      if($request->has('ids')) {
        $query->whereIn('id', json_decode($request->get('ids')));
      }

      if($request->get('rawsearch') === true) {
        return ResourcesProducts::collection($query->get());
      }

      $query->orderBy('updated_at', 'DESC');
      $products = ResourcesProducts::collection($query->paginate());

      if($request->has('type') && $request->get('type') === 'json')
        return $query->get();

      return view('components.product.list', compact('products'));
    }

    public function index($id)
    {
      return new ResourcesProducts(Product::find($id));
    }

    public function all()
    {
      return ResourcesProducts::collection(Product::orderBy('id', 'DESC')->get()->take(100));
    }

    public function store(Request $request)
    {
      $request->validate([
        'name' => 'required',
      ]);
      $slugify = new Slugify();
      $slug = $slugify->slugify($request->get('name'));
      $product = array_merge(
        $request->only(['name', 'description', 'sku', 'price', 'quantity']),
        [
          'available' => $request->get('available') == 'on' ? true : false,
          'slug' => $slug,
        ],
      );

      try {
        $product = Product::create($product);
      } catch(Exception $e) {
        dd($e->getMessage());
      }

      return redirect("/backend/products/edit/$product->id");
    }

    public function update(Request $request, $id)
    {
      $slugify = new Slugify();
      $productData = $request->only(['name', 'description', 'species', 'label', 'sku', 'available', 'product_table', 'barcode', 'quantity', 'quantity_name', 'english_name', 'english_description']);
      $productData['slug'] = $slugify->slugify($request->get('name'));
      try {
          $product = Product::find($id);
          $product->update($productData);

          // sync categories
          $product->categories()->sync(array_column($request->get('categories'), 'id'));

          // add tags to the product
          $product->tags()->sync(array_column($request->get('tags'), 'id'));

          // sync product icons
          $product->icons()->sync(array_column($request->get('icons'), 'id'));

          // add variations to the product
          $variations = $request->get('variations') ? $request->get('variations') : [];
          if(count($product->variations))
           $product->variations()->delete();
          foreach ($variations as $variation) {
            if(!isset($variation['sku'])) continue;
            $inventory = Inventory::where('sku', $variation['sku'])->first();
            if(!$inventory) {
              $inventory = Inventory::create([
                'product_id' => $product->id,
                'sku' => $variation['sku'],
                'name' => $product->name . ' - ' . $variation['value']
              ]);
            }

            if ($inventory) {
              $inventory->variant = $variation['value'];
              $inventory->save();
              ProductVariation::create([
                'product_id' => $product->id,
                'value' => $variation['value'],
                'sku' => isset($variation['sku']) ? $variation['sku'] : '',
                'quantity' => isset($variation['quantity']) ? $variation['quantity'] : 0,
                'file_path' => isset($variation['file_path']) ? $variation['file_path'] : null
              ]);
            }
          }

          // add product information
          $information = $request->has('informations') ? $request->get('informations') : [];
          if(count($product->information))
           $product->information()->delete();
           foreach ($information as $info) {
            ProductInformation::create([
              'product_id' => $product->id,
              'name' => $info['name'],
              'value' => $info['value']
            ]);
          }

          return new ResourcesProducts($product);

      } catch(Exception $e) {
        Log::error('Store product error: ' . $e->getMessage());
        return back()->with('error', $e->getMessage());
      }

      return back();
    }

    public function updateColumn(Request $request)
    {
      $product = Product::find($request->get('product_id'));
      $product->update($request->all());
    }

    public function tags($id)
    {
      $product = Product::find($id);
      return $product->tags;
    }

    public function icons($id)
    {
      $product = Product::find($id);
      return $product->icons->pluck('id');
    }

    public function media($id)
    {
      return Product::find($id)->media()->get();
    }

    public function variations($id)
    {
      $product = Product::find($id);
      return $product->variations;
    }

    public function reorderVariations(Request $request)
    {
      $variants = $request->get('variants');
      foreach($variants as $variant) {
        $v = ProductVariation::find($variant['id']);
        $v->update(['order' => $variant['order']]);
      }
      return response('success', 200);
    }

    public function destroyVariant($id)
    {
      $variation = ProductVariation::find($id);
      if($variation)
        return $variation->delete();
      return response('success', 200);
    }

    public function availableColors()
    {
      return Color::all();
    }

    public function cartProducts(Request $request)
    {
      $skus = explode(',',$request->get('p'));
      $products = array();
      foreach($skus as $sku) {
        $inventory = Inventory::where('sku', $sku)->first();
        $product = Product::where('sku', $sku)->first();
        $pv = ProductVariation::where('sku', $sku)->first();

        if(!$product)
          $product = Product::find($pv->product_id);
        $product->product_variations = $pv;
        $product->name = isset($inventory->name) ? $inventory->name : $product->name;

        array_push($products, $this->transformProductForCart($product));
      }

      return $products;
    }

    public function transformProductForCart($product)
    {
      return [
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'sku' => $product->sku,
        'slug' => $product->slug,
        'categories' => $product->categories,
        'media' => $product->media,
        'featured_image' => $product->featured_image,
        'product_variations' => $product->product_variations,
      ];
    }

    public function destroy($id)
    {
      $product = Product::find($id);
      ProductCategories::where('product_id', $product->id)->delete();
      ProductVariation::where('product_id', $product->id)->delete();
      ProductFavourite::where('product_id', $product->id)->delete();
      ProductIcon::where('product_id', $product->id)->delete();
      ProductTag::where('product_id', $product->id)->delete();
      ProductAssets::where('product_id', $product->id)->delete();
      ProductInformation::where('product_id', $product->id)->delete();
      return $product->delete();
    }
}
