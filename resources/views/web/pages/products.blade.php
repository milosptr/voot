@extends('layouts.default')

@section('title', __('default.products_title'))

@section('content')
  <section id="products">
    <div class="container mx-auto">
      <div class="py-2 mt-12 mb-6 border-b border-gray-200">
        <h1 class="text-3xl font-bold">
          @if(isset($tag))
            Tag: <span class="font-medium text-gray-700">{{ $tag->name }}</span>
          @elseif(isset($q))
            Search for: <span class="font-medium text-gray-700">{{ $q }}</span>
          @else
            {{ __('default.products_title') }}
          @endif
        </h1>
      </div>
      <div class="flex gap-12">
        <div class="w-1/4 hidden sm:flex flex-col">
          @include('web.common.categories-sidebar', ['categories' => $categories])
        </div>
        <div class="w-full sm:w-3/4">
          @if(count($products))
            @include('web.common.product-articles', ['products' => $products])
          @else
            <div class="">
              <img src="/images/undraw_lost.svg" class="w-1/3 mx-auto my-5" />
              <h2 class="w-full text-center text-grey-700 font-bold text-3xl">{{ __('default.products_not_found') }}</h2>
              <a href="/products" class="mt-4 text-primary-lighter font-medium flex items-center justify-center">
                <div class="mr-1 font-medium">{{ __('default.go_back_products') }}</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
