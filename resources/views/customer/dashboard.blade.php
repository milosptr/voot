@extends('layouts.master-admin')

@section('title', 'Dashboard Voot')

@section('content')
  <section>
    <h1 class="text-xl font-semibold text-gray-900 mr-auo mb-6">{{ __('backoffice.last_4_orders' )}}</h1>
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
      @foreach(auth()->user()->orders()->orderBy('id', 'DESC')->limit(8)->get() as $order)
        <a href="/app/orders/{{ $order['id'] }}" class="bg-white rounded-md shadow border border-gray-100 px-6 py-3">
          <div class="flex justify-between items-center">
            <div class="font-semibold text-primary-light tracking-wider text-sm">
            #{{ $order['id']}}
            </div>
            <div class="">
              @include('components.order.statuses', ['status' => $order['order_status'], 'class' => 'py-1 px-2'])
            </div>
          </div>
          <div class="text-sm text-gray-600 mt-3">
            <span class="font-medium">{{ __('backoffice.products') }}:</span> {{ count($order['order']) }}
          </div>
          <div class="text-sm text-gray-600 mt-1">
            <span class="font-medium">{{ __('backoffice.order_created') }}:</span> <span class="format-the-date">{{ $order['created_at'] }}</span>
          </div>
        </a>
      @endforeach
    </div>
     <div class="flex gap-4 items-center mt-12 mb-6">
      <h1 class="text-xl font-semibold text-gray-900">{{ __('backoffice.last_4_favourties' )}}</h1>
     </div>
     <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
      @foreach(auth()->user()->favourites()->limit(4)->get() as $product)
      <a href="{{ $product->productUrl }}" target="_blank" class="bg-white rounded-md shadow border border-gray-100 px-6 py-3 grid grid-cols-1 sm:grid-cols-2 justify-between items-center">
        <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-md" style="background-image: url('/{{ $product->featured_image ? $product->featured_image->file_path : 'images/product-placeholder.png' }}');"></div>
        <h4 class="font-medium text-sm text-gray-800">
          {{ $product->translatedName }}
        </h4>
      </a>
      @endforeach
     </div>
  </section>
@endsection
