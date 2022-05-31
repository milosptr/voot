<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
      return Staff::all();
    }

    public function store(Request $request)
    {
      foreach($request->all() as $staffMember) {
        if(isset($staffMember['id'])) {
          $staff = Staff::find($staffMember['id']);
          $staff->update($staffMember);
        } else {
          $staff = Staff::create($staffMember);
        }
      }
      return response(Staff::all(), 200);
    }

    public function destroy($id)
    {
      $staff = Staff::find($id);
      if(!isset($staff))
        return response('Staff member not found', 422);
      return $staff->delete();
    }
}
