<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartProducts;
use App\Http\Resources\ProductAsset;
use Exception;
use App\Models\Product;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Models\ProductAssets;
use App\Models\ProductVariation;
use App\Models\ProductCategories;
use App\Http\Resources\Products as ResourcesProducts;
use App\Http\Resources\ProductWithCategories;
use App\Models\Document;
use App\Models\Inventory;
use App\Models\ProductIcon;
use App\Models\ProductInformation;
use App\Models\ProductTag;
use App\Models\Tag;

class Products extends Controller
{
    public function search(Request $request)
    {

      $query = Product::query();

      if ($request->has('category')) {
        $category = $request->get('category');
        $query->leftJoin('product_categories', function ($q) use ($category) {
            $q->on('products.id', '=', 'product_categories.product_id');
        })->where('product_categories.category_id', $category);
      }

      if($request->has('s')) {
        $query->whereLike(['name', 'sku', 'english_name'], $request->get('s'));
      }

      $query->orderBy('updated_at', 'DESC');
      $products = ResourcesProducts::collection($query->paginate());

      if($request->has('type') && $request->get('type') === 'json')
        return $query->get();

      return view('components.product.list', compact('products'));
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
      $data = $request->only(['name', 'description', 'species', 'sku', 'available', 'product_table', 'english_name', 'english_description']);
      $data['available'] = $request->get('available') == 'on' ? true : false;

      try {
          $product = Product::find($id);
          $product->update($data);

          // add categories to the product
          $categories = $request->has('categories') ? explode(',', $request->get('categories')) : [];
          foreach($categories as $category) {
            if(ProductCategories::where(['product_id' => $product->id, 'category_id' => (int) $category])->first())
              continue;
            ProductCategories::create(['product_id' => $product->id, 'category_id' => (int) $category ]);
          }


          // add tags to the product
          if($request->get('tags')) {
            $tags = explode(',', $request->get('tags'));
            $slugify = new Slugify();

            foreach ($tags as $tag) {
              $slug = $slugify->slugify($tag);
              $t = Tag::where('slug', $slug)->first();
              if($t) {
                ProductTag::create([ 'product_id' => $product->id, 'tag_id' => $t->id ]);
              } else {
                $newTag = Tag::create([ 'name' => $tag, 'slug' => $slug ]);
                ProductTag::create([ 'product_id' => $product->id, 'tag_id' => $newTag->id ]);
              }
            }
          }

          // remove tags from product
          if($request->get('remove-tags')) {
            $tags = explode(',', $request->get('remove-tags'));
            foreach ($tags as $tag_id) {
              $tag = ProductTag::where('tag_id', $tag_id)->where('product_id', $id)->first();
              if($tag) {
                $tag->delete();
              }
            }
          }
          if($request->get('product-icons')) {
            $icons = explode(',', $request->get('product-icons'));
            ProductIcon::where('product_id', $product->id)->delete();
            foreach($icons as $id) {
              ProductIcon::create(['product_id' => $product->id, 'settings_icons_id' => $id]);
            }
          }

          if($request->get('documents')) {
            $documents = explode(',', $request->get('documents'));
            foreach($documents as $id) {
              $document = Document::find($id);
              $document->product_id = $product->id;
              $document->save();
            }
          }

          // add variations to the product
          $variations = $request->get('all_variations') ? json_decode($request->get('all_variations')) : [];
          foreach ($variations as $variation) {
            if(!isset($variation->sku)) continue;
            $inventory = Inventory::where('sku', $variation->sku)->first();
            if(!$inventory) {
              $inventory = Inventory::create([
                'product_id' => $product->id,
                'sku' => $variation->sku,
                'name' => $product->name . ' - ' . $variation->value
              ]);
            }
            if ($inventory) {
              $inventory->variant = $variation->value;
              $inventory->save();
              $pv = ProductVariation::where('sku', $variation->sku)->first();
              if($pv) {
                $pv->file_path = isset($variation->file_path) ? $variation->file_path : null;
                $pv->value = $variation->value;
                $pv->save();
              } else {
                ProductVariation::create([
                  'product_id' => $product->id,
                  'value' => $variation->value,
                  'sku' => isset($variation->sku) ? $variation->sku : '',
                  'quantity' => isset($variation->quantity) ? $variation->quantity : 0,
                  'file_path' => isset($variation->file_path) ? $variation->file_path : null
                ]);
              }
            }
          }

          // remove older featured images
          foreach($product->media()->where('featured_image', 1)->orderBy('id', 'DESC')->get() as $k => $m) {
            if($k === 0) continue;
            if ($m) {
              $m->featured_image = 0;
              $m->save();
            }
          }

          // add featured image
          if ($request->get('featured_image_id')) {
            ProductAssets::create([
              'product_id' => $product->id,
              'asset_id' => $request->get('featured_image_id'),
            ]);
          }

          // add gallery images
          if ($request->get('media_ids')) {
            $assets = $request->get('media_ids') ? explode(',', $request->get('media_ids')) : [];
            foreach ($assets as $asset) {
              ProductAssets::create([ 'product_id' => $id, 'asset_id' => $asset ]);
            }
          }

          // add product information
          $information = $request->has('product_information') ? json_decode($request->get('product_information')) : [];
          foreach ($information as $info) {
            if (!empty($info->name)) {
                if (isset($info->id)) {
                    $pi = ProductInformation::find($info->id);
                    $pi->name = $info->name;
                    $pi->value = $info->value;
                    $pi->save();
                } else {
                    ProductInformation::create([
                    'product_id' => $product->id,
                    'name' => $info->name,
                    'value' => $info->value
                  ]);
                }
            }
           }

      } catch(Exception $e) {
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

    public function variations($id) {
      $product = Product::find($id);
      return $product->variations;
    }

    public function destroyVariant($id) {
      $variation = ProductVariation::find($id);
      if($variation)
        return $variation->delete();
      return response('success', 200);
    }

    public function cartProducts(Request $request) {
      $skus = explode(',',$request->get('p'));
      $products = array();
      foreach($skus as $sku) {
        $inventory = Inventory::where('sku', $sku)->first();
        $product = Product::where('sku', $sku)->first();
        $pv = ProductVariation::where('sku', $sku)->first();

        if(!$product)
          $product = Product::find($pv->product_id);
        $product->product_variations = $pv;
        $product->name = $inventory->name;

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
}
