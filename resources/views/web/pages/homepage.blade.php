@extends('layouts.default')

@section('title', __('meta.homepage_title'))

@section('content')
  <div class="relative overflow-hidden border-b border-gray-200 bg-gray-50">
    <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:static flex">
        <div class="sm:w-1/2 relative z-10">
          <h1 class="text-4xl sm:text-6xl font-medium text-primary tracking-wide font-lora uppercase">{{ __('default.homepage_title') }}</h1>
          <p class="mt-4 text-lg font-light text-gray-500">{{ __('default.homepage_about')  }}</p>
          <a
            href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}"
            class="inline-block text-center bg-primary-light border border-transparent rounded-md py-3 px-8 mt-10 font-medium text-white hover:bg-primary"
            >
              {{ __('default.shop_now_button') }}
            </a>
        </div>
        <div class="sm:w-1/2">
          <div class="homepage-images-section absolute transform sm:left-1/2 top-[300px] lg:top-[-50px] left-0 sm:translate-x-8 lg:left-1/2 lg:translate-x-8 z-0">
            <div class="flex items-center space-x-6 lg:space-x-8">
              <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8 mt-20 sm:mt-10">
                <div class="homepage-hero-image w-32 sm:w-56 h-32 sm:h-80 rounded-lg overflow-hidden relative">
                  <img src="/images/homepage/homepage-5.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Útgerðir
                  </div>
                </div>
                <div class="homepage-hero-image w-32 sm:w-56 h-32 sm:h-80 rounded-lg overflow-hidden relative">
                  <img src="/images/homepage/homepage-3.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Hótel og veitingarekstur
                  </div>
                </div>
              </div>
              <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8 mt-20 sm:-mt-20">
                <div class="homepage-hero-image w-32 sm:w-56 h-32 sm:h-80 rounded-lg overflow-hidden relative">
                  <img src="/images/homepage/homepage-2.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Strandveiðar
                  </div>
                </div>
                <div class="homepage-hero-image w-32 sm:w-56 h-32 sm:h-80 rounded-lg overflow-hidden relative">
                  <img src="/images/homepage/homepage-4.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Bændur
                  </div>
                </div>
              </div>
              <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8 mt-20 sm:mt-32">
                <div class="homepage-hero-image w-32 sm:w-56 h-32 sm:h-80 rounded-lg overflow-hidden relative">
                  <img src="/images/homepage/homepage-6.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Matvælavinnslur
                  </div>
                </div>
                <div class="homepage-hero-image w-32 sm:w-52 h-32 sm:h-80 rounded-lg overflow-hidden sm:opacity-0 lg:opacity-100 relative">
                  <img src="/images/homepage/homepage-1.webp" alt="" class="w-full h-full object-center object-cover">
                  <div class="absolute left-0 top-0 w-full h-full bg-gray-900 bg-opacity-70 z-10 flex items-center justify-center text-center text-white text-2xl font-bold">
                    Verktakar
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="my-20 relative z-10">
    <div class="container mx-auto">
      <div class="flex flex-col sm:flex-row justify-between items-center border-b border-gray-100 pb-4">
        <h2 class="text-4xl sm:text-5xl font-medium font-lora tracking-wide">
          {{ __('default.products') }}
        </h2>
        <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}">{{ __('default.view_all_products') }}</a>
      </div>
      <div class="mt-6">
        @include('web.common.product-articles', ['products' => $products, 'ratio' => 'aspect-w-4 aspect-h-4'])
      </div>
    </div>
  </section>

   <section id="">
    <div class="container">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
        <div class="bg-gray-100 rounded-md p-10">
          <h2 class="text-4xl sm:text-5xl font-medium font-lora tracking-wide">
            {{ __('default.services_title') }}
          </h2>
          <p class="mt-6 font-light sm:h-20">
            {{ __('default.services_p1') }}
          </p>
          <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.services') }}" class="small-caps uppercase inline-block mx-auto border border-primary py-2 px-12 text-sm rounded-md text-primary font-medium mt-12 cursor-pointer hover:bg-primary hover:text-white ease-in-out duration-300">
             {{ __('default.explore_services') }}
          </a>
        </div>
        <div class="bg-gray-100 rounded-md p-10">
          <h2 class="text-4xl sm:text-5xl font-medium font-lora tracking-wide small-caps lowercase">
            {{ __('default.contact_title') }}
          </h2>
          <p class="mt-6 font-light sm:h-20">
            {{ __('default.contact_p1') }}
          </p>
          <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.contact') }}" class="small-caps uppercase inline-block mx-auto border border-primary py-2 px-12 text-sm rounded-md text-primary font-medium mt-12 cursor-pointer hover:bg-primary hover:text-white ease-in-out duration-300">
             {{ __('default.contact_btn') }}
          </a>
        </div>
      </div>
    </div>
   </section>

  <section class="mt-10 mb-32">
    <div class="container mx-auto relative">
      <div class="bg-gray-100 bg-opacity-80 rounded-md flex flex-col justify-center items-center py-12 px-8 sm:px-20">
        <div class="w-full sm:w-3/4">
          <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#52525b" viewBox="0 0 24 24"><path d="M4.908 17.137c1.504-2.31 1.779-4.45 1.681-5.688-6.132.101-5.696-6.449-1.39-6.449 1.83 0 3.801 1.338 3.801 4.275 0 2.724-1.412 5.845-4.092 7.862zm13 0c1.504-2.31 1.779-4.45 1.681-5.688-6.132.101-5.696-6.449-1.39-6.449 1.83 0 3.801 1.338 3.801 4.275 0 2.724-1.412 5.845-4.092 7.862zm-16.908 3.863c6.108-1.206 10-6.584 10-11.725 0-3.97-2.786-6.275-5.801-6.275-2.615 0-5.199 1.797-5.199 4.979 0 2.601 1.905 4.757 4.396 5.149-.217 2.004-2.165 4.911-4.38 5.746l.984 2.126zm13 0c6.108-1.206 10-6.584 10-11.725 0-3.97-2.786-6.275-5.801-6.275-2.615 0-5.199 1.797-5.199 4.979 0 2.601 1.905 4.757 4.396 5.149-.217 2.004-2.165 4.911-4.38 5.746l.984 2.126z"/></svg>
          </div>
          <p class="text-center my-10 font-light text-2xl sm:text-3xl text-gray-600">
            {{ __('default.quote') }}
          </p>
          <div class="flex justify-center">
            <div class="text-primary-light text-xs sm:text-base tracking-wide uppercase">{{ __('default.quote_author') }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="my-32">
    <div class="container mx-auto relative">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
        <div class="w-full sm:w-2/5">
          <h2 class="text-4xl sm:text-5xl font-medium tracking-wide font-lora">{{ __('default.newsletter_title') }}</h2>
          <p class="mt-3 font-light text-gray-700">
            {{ __('default.newsletter_desc') }}
          </p>
        </div>
        <div class="w-full sm:w-2/5">
          <form action="/api/newsletter-registration" method="POST">
            <div class="relative flex items-center">
              <input type="email" name="user_email" placeholder="Sláðu inn netfangið þitt" class="shadow-sm focus:ring-primary-lighter focus:border-primary-lighter block w-full pr-24 py-3 border-gray-200 rounded-md">
              <div class="absolute inset-y-0 right-0 flex py-2 pr-2">
                <button type="submit" class="inline-flex items-center border border-primary-lighter bg-primary-lighter text-white rounded px-6 cursor-pointer font-sans font-medium">
                  Vertu með
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection
