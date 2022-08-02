<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Product;
use App\Models\ProductAssets;
use Illuminate\Http\Request;

class AssetsUpload extends Controller
{

  public function upload(Request $req){
    $req->validate([
    'file' => 'required'
    ]);

    if($req->file()) {
        $fileName = time().'_'.$req->file->getClientOriginalName();
        $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');

        $fileModel = Asset::create([
          'name' => $fileName,
          'file_path' => $filePath,
        ]);

        if($req->has('product_id')) {
          $fileModel->product_id = $req->get('product_id');
          $product = Product::find($req->get('product_id'));
          $product->media()->attach($fileModel->id);
        }
        if($req->has('category_id'))
          $fileModel->category_id = $req->get('category_id');

        $fileModel->save();

        return response($fileModel, 200);
    }
  }

  public function newProductUpload(Request $req){
    $req->validate([
      'file' => 'required'
    ]);

    $files = isset($req->file()['file']) ? $req->file()['file'] : [];
    $uploaded = [];

    if(count($files)) {
      foreach ($files as $file) {

        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $fileModel = Asset::create([
          'name' => $fileName,
          'file_path' => $filePath,
        ]);

        if($req->has('product_id')) {
          $fileModel->product_id = $req->get('product_id');
          $product = Product::find($req->get('product_id'));
          $product->media()->attach($fileModel->id);
        }
        if ($req->has('category_id')) {
            $fileModel->category_id = $req->get('category_id');
        }
        if ($req->has('featured_image')) {
            $fileModel->featured_image = true;

        }

        $fileModel->save();
        array_push($uploaded, $fileModel);
      }
      return response($uploaded, 200);
    }
    return response('There is no file to upload', 412);
  }
}
