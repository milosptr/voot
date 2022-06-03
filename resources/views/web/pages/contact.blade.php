@extends('layouts.default')

@section('title') {{ __('header.contact') }} @endsection

@section('content')
  @foreach(App\Models\Location::all() as $location)
    @php
      $fullAddress = $location['address'] .','. $location['zip'] .','. $location['city'] .','. $location['country'];
      $urlAddress = http_build_query(['url' => $fullAddress]);
      $urlAddress = str_replace('url=','', $urlAddress);
    @endphp
    <section class="container">
      <div class="mb-16 mt-16 sm:mt-32 flex flex-col sm:flex-row lg:justify-between">
      <article class="w-full lg:w-1/4 bg-white relative pt-16 sm:border-r">
          <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">{{ $location['name'] }}</h5>
          <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
          <div class="con-fl justify-between">
            <div class="table-con">
                <div class="contact-info-ispod-mape">
                  <p class="font-bold text-base text-gray-800 mt-3">{{ __('default.address') }}</p>
                  <p class="text-base text-gray-800">{{ $location['address'] }}, {{ $location['zip'] }}, {{ $location['city'] }}, {{ $location['country'] }}</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.phone') }}</p>
                  <p class="text-base text-gray-800">{{ $location['phone'] }}</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.email') }}</p>
                  <p class="text-base text-gray-800">{{ $location['email'] }}</p>
                </div>
            </div>
            <div class="mt-5 sm:mt-16 flex"><a href="" class="pr-12"><img src="/images/face-star.svg" alt="facebook"></a> <a href="" class="pr-12 ml-6"><img src="/images/ins-star.svg" alt="instagram"></a> <a href="" class="pr-12 ml-6"><img src="/images/in-star.svg" alt="linkedin"></a></div>
          </div>
      </article>
      <article class="w-full lg:w-3/4 lg:pl-20 bg-white mt-10 sm:mt-0 rounded-md overflow-hidden"><iframe width="100%" height="600" id="gmap_canvas" class="rounded-md overflow-hidden" src="https://maps.google.com/maps?q={{ $urlAddress }}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></article>
      </div>
    </section>
  @endforeach
@endsection
