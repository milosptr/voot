<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index($id)
    {
      return Document::where('product_id', $id)->orderBy('id', 'DESC')->get();
    }

    public function store(Request $request)
    {
      if($request->file()) {
        $files = [];
        foreach ($request->documents as $file) {
          $fileModel = new Document();
          $fileName = 'P'. time().'--'.$file->getClientOriginalName();
          $filePath = $file->storeAs('uploads', $fileName, 'public');

          $fileModel->name = 'P'. $request->has('name') ? $request->get('name') : time().'--'.$file->getClientOriginalName();;
          $fileModel->file_path = $filePath;
          if($request->get('product_id'))
            $fileModel->product_id = $request->get('product_id');

          $fileModel->save();
          array_push($files,$fileModel);
        }

        return response($files, 200);
      }
    }

    public function destroy($id)
    {
      $document = Document::find($id);
      if($document)
        return $document->delete();
      return response('Already deleted', 200);
    }
}
