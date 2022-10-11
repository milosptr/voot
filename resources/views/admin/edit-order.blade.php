@extends('layouts.master-admin')

@section('title', 'Edit Order')

@section('backbutton')
  <a href="/backend/orders" class="text-pprimary-light group flex items-center px-4 py-2 text-sm font-normal rounded-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
  </a>
@endsection
@section('content')
@section('page-title', 'Edit Order')
  <section class="flex flex-col sm:flex-row gap-8">
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="/api/request-order/update/{{ $order->id }}" method="POST" class="flex flex-wrap">
          <div class="w-full flex items-center justify-between">
            <div class="w-full">
              <label for="order_status" class="block text-sm font-medium text-gray-500">Order status</label>
              @include('components.order.statuses', ['status' => $order->order_status])
            </div>
            <div class="w-full sm:pl-4">
              <label for="status" class="block text-sm font-medium text-gray-500">Change status</label>
              <select id="status" name="order_status" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md">
                @foreach(App\Models\Order::statuses() as $key => $status)
                  <option value="{{ $key }}" {{ $order->order_status === $key ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
              </select>
            </div>
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
            <label for="title" class="block text-sm font-medium text-gray-500">Customer ssn</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ $order->user->ssn ?? 'None' }}
            </div>
          </div>
          <div class="w-full sm:w-1/2 mt-4 sm:pr-4 select-none">
            <label for="email" class="block text-sm font-medium text-gray-500">Customer email</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ $order->user->email }}
            </div>
          </div>
          <div class="w-full mt-4 sm:w-1/2 sm:pl-4 select-none">
            <label for="invoice_email" class="block text-sm font-medium text-gray-500">Customer invoice email</label>
            <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
              {{ $order->user->invoice_email ?? 'None' }}
            </div>
          </div>
          <div class="w-full mt-4">
            <label for="shipping_address" class="block text-sm font-medium text-gray-500">Shipping address</label>
            <input type="text" name="shipping_address" id="shipping_address" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md" value="{{ $order->orderAddress() }}" required="">
          </div>
          <div class="w-full sm:w-1/2 sm:pr-4 mt-4">
            <label for="order_id" class="block text-sm font-medium text-gray-500">Order ID</label>
            <input type="text" name="order_id" id="order_id" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md" placeholder="{{ $order->id }}" value="{{ $order->order_id }}">
          </div>
          <div class="w-full sm:w-1/2 sm:pl-4 mt-4">
            <label for="shipping_date" class="block text-sm font-medium text-gray-500">Shipping date</label>
            <input type="date" name="shipping_date" id="shipping_date" class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
              value="{{ Carbon\Carbon::parse($order->shipping_date)->format('Y-m-d') }}"
              required="">
          </div>
          @if($order->note)
            <div class="w-full mt-4">
              <label for="title" class="block text-sm font-medium text-gray-500">Customer note</label>
              <div class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                {{ $order->note }}
              </div>
            </div>
          @endif
          <div class="w-full flex items-center gap-5 mt-8">
            <button type="submit" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
              Update order
            </button>
            <div id="openNotifyCustomerModal" class="cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
              Notify Customer
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg relative">
      <div class="px-4 py-5 sm:p-6">
        <h2 class="text-sm font-medium text-gray-500 border-b border-gray-200 pb-6">Order</h2>
        <div id="edit-order" data-order="{{ $order->id }}"></div>
      </div>
    </div>
  </section>

  <section id="order-history">
    <div class="container">
     <div class="">
        <div class="text-gray-500 mt-12 mb-2">History</div>
        <div class="history-box overflow-hidden" style="height:0;">
          @foreach($order->activityLog as $log)
            <div class="text-xs text-gray-400 mb-2">
              <span class="text-gray-500">{{ isset($log->user) ? $log->user->name : '/' }} at {{ Carbon\Carbon::parse($log->created_at)->format('m/d/Y H:m:s') }} </span>
              <br>
              <span class="tracking-wide"> {{ str_replace('}', '', str_replace('{', '', $log->from)) }}</span>
              <br>
              <span class="tracking-wide"> {{ str_replace('}', '', str_replace('{', '', $log->to)) }}</span>
            </div>
          @endforeach
        </div>
        <div class="show-history-btn inline-block px-4 py-1 text-xs bg-gray-200 border border-gray-300 rounded-md cursor-pointer text-gray-500 uppercase tracking-wide">
          Show History
        </div>
     </div>
    </div>
  </section>

  <div id="notifyCustomerModal" class="fixed left-0 top-0 w-full h-screen flex items-center justify-center hidden">
    <div class="bg-gray-900 opacity-50 absolute left-0 top-0 z-20 w-full h-screen"></div>
    <form action="/api/orders/{{ $order->id }}/notify" method="POST" class="w-full sm:w-1/2 bg-white rounded-md p-5 z-30">
      <div class="text-lg font-medium text-black">Notify the customer (optional)</div>
      <div class="text-sm text-gray-500">Write the text that will be included in the email</div>
      <div class="mt-3">
        <textarea rows="4" name="comment" id="comment" class="block w-full rounded-md resize-none border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
      </div>
      <div class="flex flex-col sm:flex-row items-center justify-between mt-3">
        <div id="closeNotifyCustomerModal" class="cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
          Cancel
        </div>
        <button type="submit" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
          Send Email
        </button>
      </div>
    </form>
  </div>
@endsection
