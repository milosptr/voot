<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index()
    {
      return Location::all();
    }

    public function store(Request $request)
    {
      foreach($request->all() as $location) {
        if(isset($location['id'])) {
          $staff = Location::find($location['id']);
          $staff->update($location);
        } else {
          $staff = Location::create($location);
        }
      }
      return response(Location::all(), 200);
    }

    public function destroy($id)
    {
      $location = Location::find($id);
      if(!isset($location))
        return response('Location not found.', 404);
      return $location->delete();
    }
}
