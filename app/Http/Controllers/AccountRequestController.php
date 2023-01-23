<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\AccountRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\AccountRequest as MailAccountRequest;

class AccountRequestController extends Controller
{
  public function store(Request $request)
  {
    try {
      $data = $request->only(['name','email','invoice_email','phone','ssn','company','company_ssn','simi']);
      $request = AccountRequest::create($data);

      try {
        $config = Config::where('key', 'password_request_recipients')->orderBy('id', 'DESC')->get()->first();
        $defaultRecipients = isset($config['value']) ? explode(';', $config['value']) : ['milosptr@icloud.com'];
        foreach ($defaultRecipients as $recipient) {
          if(!empty($recipient)) {
            Mail::to($recipient)
              ->send(new MailAccountRequest());
            Log::info('AccountRequestController::class email sent to '.$recipient);
          }
        }
      } catch (Exception $e) {
        Log::error('AccountRequestController::class email error' .$e->getMessage());
      }

      return Redirect::to('/password-reset?title=Ósk um aðgang&status=Við hðfum móttekið beiðni þína og munum senda þér lykilorð til innskráningar eins fjótt og auðið er.');
    } catch(Exception $e) {
      Log::error('AccountRequestController::class ' .$e->getMessage());
      return Redirect::to('/password-reset?title=Eitthvað fór úrskeiðis&status=Vinsamlegast reyndu aftur eða hafðu samband við söludeild okkar.');
    }
  }

  public function toggleStatus($id)
  {
    $account = AccountRequest::find($id);
    if($account) {
      $account->update(['finished' => !$account->finished]);
    }
    return response('Updated!', 200);
  }
}
