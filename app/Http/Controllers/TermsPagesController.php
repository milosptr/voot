<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class TermsPagesController extends Controller
{
    public function index()
    {
      return Page::all();
    }

    public function store(Request $request)
    {
      foreach($request->all() as $p) {
        if(isset($p['id'])) {
          $page = Page::find($p['id']);
          $page->update($p);
        } else {
          $page = Page::create($p);
        }
      }
      return response(Page::all(), 200);
    }

    public function destroy($id)
    {
      $page = Page::find($id);
      if(!isset($page))
        return response('Page not found.', 404);
      return $page->delete();
    }
}
