<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Newsletter\Newsletter;

class MailChimpController extends Controller
{
    public function store(Request $request)
    {
      if($request->has('user_email')) {
        if ( ! app(Newsletter::class)->isSubscribed($request->get('user_email')) ) {
          app(Newsletter::class)->subscribe($request->get('user_email'));
          return Redirect::to('/newsletter-registration?title=Fréttabréf&status=Vel heppnuð skráning á Vote fréttabréf! Þakka þér fyrir.');
        }
        return Redirect::to('/newsletter-registration?title=Fréttabréf&status=Þessi tölvupóstur er þegar skráður á fréttabréfalistann okkar.');
      }
      return Redirect::to('/newsletter-registration?title=Fréttabréf&status=Vinsamlegast gefðu upp rétt netfang.');
    }

    public function destroy(Request $request)
    {
      if (app(Newsletter::class)->isSubscribed($request->get('user_email')) ) {
        app(Newsletter::class)->delete($request->get('user_email'));
      }
      return back();
    }
}
