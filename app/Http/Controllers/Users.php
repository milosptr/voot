<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Events\UserPasswordReset;
use App\Events\UserVerified;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;

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

    public function invoiceEmail(Request $request, $id)
    {
      $user = User::find($id);
      $user->update($request->only('invoice_email'));

      return back();
    }

    public function companies($id)
    {
      $user = User::find($id);
      return UserResource::collection($user->companies);
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
      $password = User::resetPassword();
      $user->update(['password' => Hash::make($password)]);

      UserPasswordReset::dispatch($user, $password);

      return back();
    }

    public function changePassword(Request $request, $id)
    {
      $user = User::find($id);
      if($request->has('password')) {
        $user->update(['password' => Hash::make($request->get('password'))]);
      }
      return Redirect::to('/app/account?status=Password changed');
    }

    public function verify($id)
    {
      $user = User::find($id);
      $user->update(['email_verified_at' => Carbon::now()]);

      UserVerified::dispatch($user);

      return back();
    }

    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();

      return redirect()->intended('/backend/settings/clients');
    }
}
