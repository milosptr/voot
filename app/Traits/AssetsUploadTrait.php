<?php
namespace App\Traits;

use App\Models\Asset;
use Illuminate\Http\Request;

trait AssetsUploadTrait {

  public static function upload(Request $request)
  {
    $fileModel = new Asset();

    if($request->file()) {
        $file = count($request->file) == 1 ? $request->file[0] : $request->file;

        $fileName = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $fileModel->name = $fileName;
        $fileModel->file_path = $filePath;
        if($request->has('product_id'))
          $fileModel->product_id = $request->get('product_id');
        if($request->has('category_id'))
          $fileModel->category_id = $request->get('category_id');

        $fileModel->save();

        return $fileModel;
    }
    return null;
  }

}
