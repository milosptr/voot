@extends('layouts.default')

@section('title') Homepage @endsection

@section('content')
  <section id="hero-section" class="h-screen bg-primary-lightest">
    <div class="z-0 w-full h-full absolute bottom-0 left-0 bg-cover bg-no-repeat bg-bottom" style="background-image: url('/images/wave-haikei.svg');"></div>
    <div class="container">
      <div class="relative text-center z-10">
        <h1 class="text-primary text-6xl tracking-wider leading-normal uppercase pt-32 pb-10 font-lora">{{ __('default.homepage_title') }}</h1>
        <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-10 mt-32">
          @foreach(App\Models\Category::where('parent_id', 0)->get() as $category)
            <a href="/{{ $category->slug }}" class="block single-article-product cursor-pointer order-{{ $category->order }}">
              <div class="w-2/3 mx-auto">
                <img src="/images/categories/{{ $category->slug }}.svg" alt="{{ $category->slug }}" width="100%" />
              </div>
              <div class="text-xl font-medium text-center mt-3 text-gray-800 tracking-wide leading-normal">
                {{ $category->translatedName }}
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section class="bg-primary-lightest h-80">
    <div class="container relative">
      <div class="absolute left-0 top-0 w-full z-10 -mt-24">
        <div class="w-4/5 mx-auto ">
          <img src="/images/pjon-mapa.svg" width="100%" alt="pjon map" />
        </div>
      </div>
    </div>
  </section>
  <section class="relative  bg-primary-lightest py-32">
    <div class="container relative z-10">
      <div class="text-center w-2/3 mx-auto">
        <h2 class="text-6xl font-medium tracking-wide font-lora">{{ __('default.about_voot_title') }}</h2>
        <p class="mt-6 text-lg">{!! __('default.homepage_about') !!}</p>
          <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.about') }}" class="inline-block mx-auto border border-primary py-3 px-24 rounded-md text-primary font-medium my-6 mt-12 cursor-pointer hover:bg-primary hover:text-white ease-in-out duration-300">
            Read more about Voot
          </a>
      </div>
    </div>
  </section>

  <section class="my-20">
    <div class="container mx-auto">
      <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <h2 class="text-6xl font-medium font-lora tracking-wide">
          {{ __('default.products') }}
        </h2>
        <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}">{{ __('default.view_all_products') }}</a>
      </div>
      <div class="mt-6">
        @include('web.common.product-articles', ['products' => $products, 'ratio' => 'aspect-w-4 aspect-h-4'])
      </div>
    </div>
  </section>

   <section class="my-48">
    <div class="container mx-auto relative">
      <div class="flex flex-col sm:flex-row items-center justify-between">
        <div class="sm:w-1/2">
          <h2 class="text-6xl font-medium font-lora tracking-wide">
            {{ __('default.services_title') }}
          </h2>
          <p class="mt-6 text-lg">
            {{ __('default.services_p1') }}
          </p>
          <a href="/about" class="inline-block mx-auto border border-primary py-3 px-24 rounded-md text-primary font-medium mt-12 cursor-pointer hover:bg-primary hover:text-white ease-in-out duration-300">
             {{ __('default.explore_services') }}
          </a>
        </div>
        <div class="sm:w-1/2 flex justify-end">
          <div class="grid grid-cols-3 grid-rows-2 items-center justify-items-center gap-10 opacity-90">
            <img src="/images/categories/oryggis-og-vinnufatnadur.svg" alt="oryggis-og-vinnufatnadur" width="120" />
            <img src="/images/categories/rekstrarvorur.svg" alt="rekstrarvorur" width="120" />
            <img src="/images/categories/oliu-and-smurefni.svg" alt="oliu-and-smurefni" width="120" />
            <img src="/images/categories/beita.svg" alt="beita" width="120" />
            <img src="/images/categories/fishing-gear.svg" alt="fishing-gear" width="120" />
            <img src="/images/categories/vessel.svg" alt="vessel" width="120" />
          </div>
        </div>
      </div>
    </div>
   </section>

   <section class="my-48">
    <div class="container mx-auto relative">
      <div class="flex flex-col sm:flex-row items-center justify-between">
        <div class="sm:w-1/2 flex justify-end">

        </div>
        <div class="sm:w-1/2">
          <h2 class="text-6xl font-medium font-lora tracking-wide">
            {{ __('default.contact_title') }}
          </h2>
          <p class="mt-6 text-lg">
            {{ __('default.contact_p1') }}
          </p>
          <a href="/about" class="inline-block mx-auto border border-primary py-3 px-24 rounded-md text-primary font-medium my-6 mt-12 cursor-pointer hover:bg-primary hover:text-white ease-in-out duration-300">
             {{ __('default.contact_btn') }}
          </a>
        </div>
      </div>
    </div>
   </section>

  <section class="my-32">
    <div class="container mx-auto relative">
      <div class="bg-primary-lightest rounded-md flex flex-col justify-center items-center py-12 px-20">
        <div class="w-full sm:w-3/4">
          <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#52525b" viewBox="0 0 24 24"><path d="M4.908 17.137c1.504-2.31 1.779-4.45 1.681-5.688-6.132.101-5.696-6.449-1.39-6.449 1.83 0 3.801 1.338 3.801 4.275 0 2.724-1.412 5.845-4.092 7.862zm13 0c1.504-2.31 1.779-4.45 1.681-5.688-6.132.101-5.696-6.449-1.39-6.449 1.83 0 3.801 1.338 3.801 4.275 0 2.724-1.412 5.845-4.092 7.862zm-16.908 3.863c6.108-1.206 10-6.584 10-11.725 0-3.97-2.786-6.275-5.801-6.275-2.615 0-5.199 1.797-5.199 4.979 0 2.601 1.905 4.757 4.396 5.149-.217 2.004-2.165 4.911-4.38 5.746l.984 2.126zm13 0c6.108-1.206 10-6.584 10-11.725 0-3.97-2.786-6.275-5.801-6.275-2.615 0-5.199 1.797-5.199 4.979 0 2.601 1.905 4.757 4.396 5.149-.217 2.004-2.165 4.911-4.38 5.746l.984 2.126z"/></svg>
          </div>
          <p class="text-center my-10 font-light text-3xl text-gray-600">
            Við erum gríðarlega stolt af því að vera hluti af íslenskum sjávarútvegi og munum áfram leggja okkur fram um að eiga í góðu samstarfi við fyrirtæki í sjávarútvegi og hjálpa þeim að búa til verðmæti.
          </p>
          <div class="flex justify-center">
            <div class="text-primary-light tracking-wide uppercase">- Vignir Óskarsson, Framkvæmdastjóri</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="my-32">
    <div class="container mx-auto relative">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
        <div class="w-full sm:w-2/5">
          <h2 class="text-5xl font-medium tracking-wide font-lora">{{ __('default.newsletter_title') }}</h2>
          <p class="mt-3 font-light text-gray-700">
            {{ __('default.newsletter_desc') }}
          </p>
        </div>
        <div class="w-full sm:w-2/5">
          <form action="" method="POST">
            <div class="relative flex items-center">
              <input type="email" name="email" placeholder="Enter your email" class="shadow-sm focus:ring-primary-lighter focus:border-primary-lighter block w-full pr-24 py-3 border-gray-200 rounded-md">
              <div class="absolute inset-y-0 right-0 flex py-2 pr-2">
                <kbd class="inline-flex items-center border border-primary-lighter bg-primary-lighter text-white rounded px-6 cursor-pointer font-sans font-medium">
                  Join
                </kbd>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

@endsection
