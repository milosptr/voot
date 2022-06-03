@extends('layouts.master-admin')

@section('title', 'Dashboard Voot')

@section('content')
  <section>
    <h1 class="text-2xl font-semibold text-gray-900 mr-auo mb-12">{{ __('default.orders_title')}}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      @foreach(auth()->user()->orders()->orderBy('id', 'DESC')->get() as $order)
        <a href="/app/orders/{{ $order->id }}" class="block bg-white rounded-md shadow p-6 text-gray-700">
          <div class="flex items-center justify-between">
            <div class="text-lg font-bold tracking-wider">#{{ $order->id }}</div>
            @include('components.order.statuses', ['status' => $order->order_status])
          </div>
          <div class="text-sm tracking-wider text-gray-400">{{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y. H:s') }}</div>
          <div class="mt-4 text-sm font-medium text-gray-500">Shipping to</div>
          <div class="text-sm tracking-wide font-medium">{{ $order->shipping_address }}</div>
          <div class="mt-4 text-sm font-medium text-gray-500">Shipping date</div>
          <div class="text-sm tracking-wide font-medium">{{ Carbon\Carbon::parse($order->shipping_date)->format('d.m.Y.') }}</div>
        </a>
      @endforeach
    </div>
  </section>
@endsection
