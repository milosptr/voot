@extends('layouts.default')

@section('title', __('default.thank_you_title'))

@section('content')
  <section>
    <div class="mt-24">
      <div class="max-w-7xl mx-auto py-12 pb-32 px-4 sm:px-6 text-center">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl mb-20">
          <span class="block font-bold">{{ __('default.thanks_title') }}</span>
          <span class="text-lg block mt-2 text-gray-400">{{ __('default.thanks_subtitle') }}</span>
        </h2>
        <div class="mx-auto flex lg:mt-0 lg:flex-shrink-0 justify-center">
          <div class="inline-flex rounded-md shadow">
            <a href="/app/orders" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50">
              {{ __('default.thanks_check_btn') }}
            </a>
          </div>
          <div class="ml-5 inline-flex rounded-md shadow">
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
              {{ __('default.thanks_goback_btn') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
