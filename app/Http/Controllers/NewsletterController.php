<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{

    public function index()
    {
      return new NewsletterResource(Newsletter::all()->last());
    }
    public function store(Request $request)
    {
      if($request->has('id')) {
        $newsletter = Newsletter::find($request->get('id'));
        $newsletter->update($request->all());
        return $newsletter;
      }
      return Newsletter::create($request->all());
    }

    public function destroy($id)
    {
      $newsletter = Newsletter::find($id);
      return $newsletter->delete();
    }
}
