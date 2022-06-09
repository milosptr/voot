@extends('layouts.master-admin')

@section('title', 'Dashboard Voot')

@section('content')
  <section class="flex flex-col sm:flex-row gap-8">
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="/api/request-order/update/{{ $order->id }}" method="POST" class="flex flex-wrap">
          <div class="w-full">
            <label for="order_status" class="block text-sm font-medium text-gray-500">Order status</label>
            @include('components.order.statuses', ['status' => $order->order_status])
          </div>
          <div class="w-full sm:w-1/2 sm:pr-4 mt-4">
            <label for="created_at" class="block text-sm font-medium text-gray-500">Created at</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y. H:s') }}
            </div>
          </div>
          <div class="w-full sm:w-1/2 sm:pl-4 mt-4">
            <label for="updated_at" class="block text-sm font-medium text-gray-500">Last updated at</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ Carbon\Carbon::parse($order->updated_at)->format('d.m.Y. H:s:i') }}
            </div>
          </div>
          <div class="w-full sm:w-1/2 mt-4 sm:pr-4 select-none">
            <label for="customer" class="block text-sm font-medium text-gray-500">Customer name</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ $order->user->name }}
            </div>
          </div>
          <div class="w-full mt-4 sm:w-1/2 sm:pl-4 select-none">
            <label for="title" class="block text-sm font-medium text-gray-500">Customer key</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ $order->user->key }}
            </div>
          </div>
          <div class="w-full mt-4">
            @if($order->shipping_method == App\Models\Order::DELIVERY)
              <label for="shipping_address" class="block text-sm font-medium text-gray-500">Shipping address</label>
            @else
              <label for="shipping_address" class="block text-sm font-medium text-gray-500">Pickup address</label>
            @endif
            @if($order->order_status <= 1)
              <input type="text" name="shipping_address" id="shipping_address" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md" value="{{ $order->shipping_address }}" required="">
            @else
              <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                {{ $order->orderAddress }}
              </div>
            @endif
          </div>
          <div class="w-full sm:w-1/2 mt-4 sm:pr-4">
            <label for="shipping_date" class="block text-sm font-medium text-gray-500">Shipping date</label>
            @if($order->order_status <= 1)
              <input type="date" name="shipping_date" id="shipping_date" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
                value="{{ Carbon\Carbon::parse($order->shipping_date)->format('Y-m-d') }}"
                min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                required="">
            @else
              <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                {{ Carbon\Carbon::parse($order->shipping_date)->format('d.m.Y') }}
              </div>
            @endif
          </div>
          <div class="w-full sm:w-1/2 mt-4 sm:pr-4">
            <label for="shipping_date" class="block text-sm font-medium text-gray-500">Shipping method</label>
              <div data-method="{{ $order->shipping_method }} {{ App\Models\Order::DELIVERY }}" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                @if($order->shipping_method == App\Models\Order::DELIVERY)
                  Delivery
                @else
                  Pickup
                @endif
              </div>
          </div>
          @if($order->note)
            <div class="w-full mt-4">
              <label for="title" class="block text-sm font-medium text-gray-500">Customer note</label>
              @if($order->order_status > 3)
                <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                  {{ $order->note }}
                </div>
              @else
                <textarea name="note" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md">{{ $order->note }}</textarea>
              @endif
            </div>
          @endif
          @if($order->order_status <= 3)
          <div class="w-full mt-8 flex justify-between">
            <button type="submit" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
              Update order
            </button>
            <a href="/api/orders/{{ $order->id }}/reorder" class="border border-primary-lighter text-primary-lighter hover:text-white group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
              Reorder
            </a>
          </div>
          @endif
        </form>
      </div>
    </div>
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <h2 class="text-sm font-medium text-gray-500 border-b border-gray-200 pb-6">Order</h2>
        @foreach($order->order as $o)
          @php
            $product = App\Models\Inventory::where('sku', $o['sku'])->first();
            $pv = App\Models\ProductVariation::where('sku', $o['sku'])->first();
          @endphp
          <div class="flex items-center gap-4 border-b border-gray-200 text-gray-700 py-1 px-3">
            <img src="/{{ isset($pv->product->featured_image) ? $pv->product->featured_image->file_path : 'images/product-placeholder.png' }}" width="24" alt="{{ $o['sku'] }}" />
            <a href="/product/{{ $pv->product->slug }}" target="_blank" >{{ $product->name }} <span class="font-medium"> ( x {{ $o['qty'] }} )</span></a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
