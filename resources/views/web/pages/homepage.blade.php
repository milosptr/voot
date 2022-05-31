@extends('layouts.default')

@section('title') Homepage @endsection

@section('content')
  <section id="hero-section" class="h-screen">
    <div class="z-0 w-full h-full absolute bottom-0 left-0 bg-contain bg-no-repeat bg-bottom opacity-70" style="background-image: url('/images/pjon-bac.png');"></div>
    <div class="container">
      <div class="relative text-center z-10">
        <h1 class="text-primary text-6xl tracking-wider leading-normal uppercase pt-32 font-lora">{{ __('default.homepage_title') }}</h1>
        <div class="w-0.5 h-32 bg-primary mx-auto mt-4"></div>
        <a href="/" class="inline-block mx-auto border border-primary py-3 px-24 rounded-md text-primary font-medium my-6 cursor-pointer hover:bg-primary hover:text-white">
          Flettu Niður
        </a>
        <div class="w-0.5 h-32 bg-primary mx-auto"></div>
        <div class="w-3 h-3 rounded-full border-2 border-primary mx-auto"></div>

        {{-- <div class="grid grid-cols-2 grid-rows-2 gap-12 w-1/2 ml-auto lg:pl-16">
          @foreach(App\Models\Category::where('parent_id', 0)->get() as $category)
            <article class="single-article-product {{ $loop->index % 2 === 0 ? 'mt-10' : '' }}">
              <a href="/{{ $category->slug }}" class="block cursor-pointer order-{{ $category->order }}">
                <div id="single-product-bigimage" class="w-full max-h-290 aspect-w-1 aspect-h-1 single-product-gallery--big rounded-md border border-gray-100 shadow-sm">
                  <div class="h-full bg-cover bg-center bg-no-repeat rounded-md single-product-bigimage-url" data-zoom="/{{ isset($category->image) ? $category->image->file_path : 'images/product-placeholder.png' }}" style="background-image: url('/{{ isset($category->image) ? $category->image->file_path : 'images/product-placeholder.png' }}')"></div>
                </div>
                <div class="text-xl font-medium text-center mt-3 text-gray-800 tracking-wide leading-normal">
                  {{ $category->name }}
                </div>
              </a>
            </article>
          @endforeach
        </div> --}}
      </div>
    </div>
  </section>

  {{-- <section class="mt-6">
    <div class="container mx-auto">
      <div class="grid grid-cols-3 gap-6">
        @foreach($categories as $category)
          <a href="/{{ $category->slug }}" class="relative block">
            <div
              class="w-full aspect-w-16 aspect-h-9 rounded-md bg-gray-50"
            >
              <div class="m-auto bg-cover bg-center bg-no-repeat rounded-lg" style="background-image: url('/{{ isset($category->image) ? $category->image->file_path : 'images/product-placeholder.png' }}')"></div>
            </div>
            <h4 class="w-full font-semibold text-xl text-gray-800 mt-3 text-center">{{ $category->name }}</h4>
          </a>
        @endforeach
      </div>
    </div>
  </section> --}}

  <section>
    <div class="container mx-auto pb-10">
      <div class="w-full grid grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-10 mt-20">
        @foreach(App\Models\Category::where('parent_id', 0)->get() as $category)
        <article class="single-article-product">
          <a href="/{{ $category->slug }}" class="block cursor-pointer order-{{ $category->order }}">
            <div id="single-product-bigimage" class="w-full max-h-290 aspect-w-1 aspect-h-1 single-product-gallery--big rounded-md border border-gray-100 shadow-sm">
              <div class="h-full bg-cover bg-center bg-no-repeat rounded-md single-product-bigimage-url" data-zoom="/{{ isset($category->image) ? $category->image->file_path : 'images/product-placeholder.png' }}" style="background-image: url('/{{ isset($category->image) ? $category->image->file_path : 'images/product-placeholder.png' }}')"></div>
            </div>
            <div class="text-xl font-medium text-center mt-3 text-gray-800 tracking-wide leading-normal">
              {{ $category->name }}
            </div>
          </a>
        </article>
        @endforeach
      </div>
    </div>
  </section>

  <section class="mt-20">
    <div class="container mx-auto">
      <div class="flex justify-between items-center border-b border-gray-100 pb-4">
        <h2 class="text-5xl font-medium font-lora tracking-wide">
          {{ __('default.products') }}
        </h2>
        <a href="/products">{{ __('default.view_all_products') }}</a>
      </div>
      <div class="mt-6">
        @include('web.common.product-articles', ['products' => $products, 'ratio' => 'aspect-w-4 aspect-h-4'])
      </div>
    </div>
  </section>

  <section class="mt-20 py-12" style="background: linear-gradient(90deg,#10253a,#00151d);">
    <div class="container mx-auto relative">
      <div class="rounded-md flex flex-col sm:flex-row items-center py-12 px-20" >
        <div class="w-full sm:w-1/3 text-white">
          <h2 class="text-5xl font-medium tracking-wide font-lora">{{ __('default.about_voot_title') }}</h2>
          <p class="mt-6 font-light text-lg">{!! __('default.homepage_about') !!}</p>
          <a href="/about" class="w-64 mt-8 flex items-center justify-center py-2 px-4 rounded-md text-primary bg-white border-1 border-solid border-white hover:text-white hover:bg-primary ease-in-out duration-300">
            Read more about Voot
          </a>
        </div>
        <div class="w-full sm:w-2/3 flex justify-center sm:justify-end absolute sm:relative mt-12 sm:mt-0 top-0 right-0 opacity-20 sm:opacity-100">
          <img src="/images/pjon-mapa.svg" width="85%" alt="pjon map" />
        </div>
      </div>
    </div>
  </section>

  <section class="mt-32">
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

  <section class="mt-32 mb-32">
    <div class="container mx-auto relative">
      <div class="bg-gray-100 rounded-md flex flex-col justify-center items-center py-12 px-20">
        <div class="w-full sm:w-1/2">
          <div class="text-center text-4xl italic leading-3 text-gray-700">
            "
          </div>
          <p class="text-center my-10 font-light text-gray-600">
            Við erum gríðarlega stolt af því að vera hluti af íslenskum sjávarútvegi og munum áfram leggja okkur fram um að eiga í góðu samstarfi við fyrirtæki í sjávarútvegi og hjálpa þeim að búa til verðmæti.
          </p>
          <div class="flex justify-center">
            <a href="#" class="font-medium text-primary-light">Vignir Óskarsson</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
