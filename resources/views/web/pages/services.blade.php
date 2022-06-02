@extends('layouts.default')

@section('title', __('header.services'))

@section('content')
  <section>
    <div class="container mx-auto pt-20">
      <h2 class="text-6xl font-medium tracking-wide font-lora">{{ __('header.services') }}</h2>
    </div>
  </section>

  <section>
    <div class="container mx-auto pb-10">
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
  </section>

  <section class="pt-20 pb-32 relative">
    <div class="container mx-auto relative z-10">
      <div class="flex flex-wrap items-end">
        <div class="w-full sm:w-1/2">
          <img src="/images/pjon-map-dark.svg" class="w-full sm:w-4/5" alt="pjon map">
          <div class="flex gap-10 mt-5">
            <a href="{{ __('header.current_language') }}/{{ __('header.all_products_url') }}" class="w-48 mt-8 flex items-center justify-center py-2 px-4 rounded-md text-white text-center bg-primary border-1 border-solid border-primary hover:text-primary hover:bg-transparent ease-in-out duration-300">
              {{ __('header.products') }}
            </a>
            <a href="{{ __('header.current_language') }}/{{ __('header.contact_url') }}" class="w-48 mt-8 flex items-center justify-center py-2 px-4 rounded-md text-primary text-center bg-transparent border-1 border-solid border-primary hover:text-white hover:bg-primary ease-in-out duration-300">
              {{ __('header.contact') }}
            </a>
          </div>
        </div>
        <div class="w-full sm:w-1/2">
          <p class="mb-10 leading-normal">{{ __('default.services_p1')  }}</p>
          <p class="mb-10 leading-normal">{{ __('default.services_p2')  }}</p>
          <p class="leading-normal">{{ __('default.services_p3')  }}</p>
        </div>
      </div>
    </div>
    <div class="z-0 w-full h-full absolute bottom-0 left-0 bg-cover bg-left-top opacity-40" style="background-image: url('/images/pjon-bac.png');"></div>
  </section>
@endsection
