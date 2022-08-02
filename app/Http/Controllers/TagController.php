<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
      $tag = Tag::where('name', $request->get('name'))->get()->first();

      if(!$tag) {
        $slugify = new Slugify();
        $slug = $slugify->slugify($request->get('name'));
        $tag = Tag::create([
          'name' => $request->get('name'),
          'slug' => $slug
        ]);
      }

      return $tag;
    }
}
