<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Events\UserPasswordReset;
use App\Events\ForgotPassword;
use App\Events\UserVerified;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

      return Redirect::back()->with('status', 'New user info saved!');
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

      return Redirect::back()->with('status', 'New password sent to the customer!');
    }

    public function forgotPassword(Request $request, $id = null)
    {
      if($id === null) {
        $user = User::where('email', $request->get('email'))->get()->first();
        if(isset($user)) {
          ForgotPassword::dispatch($user);
          return Redirect::to('/password-reset?title=Endurstilla lykilorð&status=Athugaðu tölvupóstinn þinn og staðfestu endurstillingu lykilorðsins. Vinsamlegast athugaðu að tölvupósturinn gæti hafa endað í rusl hólfinu.');
        }
        return Redirect::to('/password-reset?title=Endurstilla lykilorð&status=Enginn notandi fannst með uppgefið netfang.');
      }
      try {
        $user = User::find($id);
        $password = User::resetPassword();
        $user->update(['password' => Hash::make($password)]);
        UserPasswordReset::dispatch($user, $password);
        return Redirect::to('/password-reset?title=Endurstilla lykilorð&status=Við höfum sent þér tölvupóstinn sem inniheldur nýja lykilorðið þitt. Vinsamlegast athugaðu að tölvupósturinn gæti hafa endað í rusl hólfinu.');
      } catch(Exception $e) {
        Log::error('Something went wrong changing the user password (forgotPassword) '. $e->getMessage());
        return Redirect::to('/password-reset?title=Endurstilla lykilorð&status=Eitthvað fór úrskeiðis við að breyta lykilorðinu þínu. Vinsamlegast reyndu aftur.');
      }
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

      return Redirect::back()->with('status', 'User verified!');
    }

    public function destroy($id)
    {
      $user = User::find($id);
      $user->delete();

      return redirect()->intended('/backend/settings/clients');
    }
}
