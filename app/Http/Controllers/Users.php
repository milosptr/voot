<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Asset;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;

class Users extends Controller
{
    public function index($id)
    {
      $user = User::find($id);
      if($user)
        return new UserResource($user);
      return null;
    }

    public function search(Request $request)
    {
      if($request->has('s'))
        return User::search($request->get('s'), true);
      return User::search();
    }

    public function update(Request $request, $id)
    {
      $user = User::find($id);
      $user->update($request->all());

      return back();
    }

    public function logo(Request $request, $id)
    {
      $user = User::find($id);
      $logo = Asset::upload($request);

      $user->update([ 'logo' => $logo->file_path ]);

      return response('Client logo successfully added!', 200);
    }

    public function resetPassword($id)
    {
      $user = User::find($id);
      $user->password = User::resetPassword($id);
      $user->save();

      return back();
    }

    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();

      return redirect()->intended('/backend/settings/clients');
    }
}
