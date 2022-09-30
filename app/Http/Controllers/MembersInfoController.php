<?php

namespace App\Http\Controllers;

use App\Models\MemberInfo;
use Illuminate\Http\Request;

class MembersInfoController extends Controller
{
    public function index($id)
    {
      return MemberInfo::where('user_id', $id)->get();
    }

    public function store(Request $request)
    {
      return MemberInfo::create($request->all());
    }

    public function edit(Request $request, $id)
    {
      $memberInfo = MemberInfo::find($id);
      return $memberInfo->update($request->all());
    }

    public function destroy($id)
    {
      $member = MemberInfo::find($id);
      return $member->delete();
    }
}
