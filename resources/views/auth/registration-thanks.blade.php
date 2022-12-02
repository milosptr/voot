@extends('layouts.default')
@section('title', 'Thank you for registration!')

@section('content')
<section class="flex items-center justify-center page-not-found-section">
    <div class="w-full sm:w-1/2 text-center">
      <h2 class="text-primary-lighter font-bold tracking-wider">Skráning í bið</h2>
      <h1 class="text-5xl font-bold my-2">Takk fyrir</h1>
      <p class="text-warmGray-500">Við erum núna að vinna úr skráningu þinni, þú færð tölvupóst þegar þú ert samþykktur. Vinsamlegast athugaðu að tölvupósturinn gæti hafa endað í rusl hólfinu.<br><br>Þú getur nú búið til pöntun.</p>
      <a href="/" class="mt-4 text-primary-lighter font-medium flex items-center justify-center">
        <div class="mr-1 font-medium">{{ __('default.go_back_to_home') }}</div>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
  </section>
@endsection
