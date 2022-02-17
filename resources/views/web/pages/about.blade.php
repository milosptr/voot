@extends('layouts.default')

@section('title', __('header.about'))

@section('content')
  <section>
    <div class="container mx-auto py-20">
      <h2 class="text-2xl font-medium tracking-wide w-1/2 leading-normal">{{ __('default.about_voot_short') }}</h2>
    </div>
  </section>

  <section>
    <div class="container mx-auto">
      <div class="overflow-hidden rounded-md">
        <img src="/images/iceland-ship.jpeg" width="100%" alt="{{ __('header.about') }}" />
      </div>
    </div>
  </section>

  <section class="py-20">
    <div class="container mx-auto">
      <div class="w-2/3">
        <p class="mb-10 leading-normal">{{ __('default.about_p1')  }}</p>
        <p class="leading-normal">{{ __('default.about_p2')  }}</p>
      </div>
    </div>
  </section>

  <section>
    <div class="container mx-auto">
      <div class="flex items-center">
        <div class="w-1/2">
          <div id="google-maps-component"></div>
        </div>
      </div>
    </div>
  </section>
@endsection
