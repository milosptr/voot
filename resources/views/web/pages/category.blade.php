@extends('layouts.default')

@section('title', $category->translatedName)

@section('content')
  <section id="products">
    <div class="container mx-auto">
      <div class="py-2 mt-12 flex items-center mb-6 border-b border-gray-200">
        @if($category->parentCategory())
        <a href="/{{ $category->parentCategory()->slug }}" class="text-gray-900">
        @else
        <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}" class="text-gray-900">
        @endif
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-3"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <h1 class="text-2xl sm:text-3xl font-bold">{{ $category->translatedName }}</h1>
      </div>
      <div class="flex gap-12">
        <div class="hidden sm:w-1/4 sm:flex flex-col">
          @include('web.common.categories-sidebar', ['categories' => $categories])
        </div>
        <div class="sm:w-3/4">
          @if(!count($category->subcategory(true)) && count($products))
            @include('web.common.product-articles', ['products' => $products, 'sort' => true])
          @elseif(!count($products))
            <div class="">
              <img src="/images/undraw_lost.svg" class="w-1/3 mx-auto my-5" />
              <h2 class="w-full text-center text-grey-700 font-bold text-3xl">{{ __('default.products_not_found') }}</h2>
              <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}" class="mt-4 text-primary-lighter font-medium flex items-center justify-center">
                <div class="mr-1 font-medium">{{ __('default.go_back_products') }}</div>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
              </a>
            </div>
          @else
            @include('web.common.category-articles', ['categories' => $category->subcategory(true), 'sort' => true])
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
