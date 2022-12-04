@extends('layouts.master-admin')

@section('title', 'Orders')

@section('page-title', 'Orders')
@section('content')
  <section>
    @include('components.order.filter')
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Order ID
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Customer
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Products
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
            Status
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
            AX Status
          </th>
          <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
            Salesman
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Created At
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 text-sm">
        @php
          $orders = App\Models\Order::orderBy('updated_at', 'DESC');
          if(isset($_GET['customer']))
            $orders->where('user_id', $_GET['customer']);
          if(isset($_GET['status']))
            $orders->where('order_status', $_GET['status']);
          $orders = $orders->get();
        @endphp
        @foreach($orders as $order)
          <tr class="cursor-pointer hover:bg-gray-50" onclick="window.open('/backend/orders/{{ $order->id }}', '_self')">
            <td class="px-6 py-3 whitespace-nowrap">
              <div class="font-medium">#{{ $order->order_id ?: $order->id }}</div>
            </td>
            <td class="px-6 py-3 whitespace-nowrap">
              {{ $order->user->name }}
            </td>
            <td class="px-6 py-3 whitespace-nowrap">
              {{ count($order->order) }} {{ count($order->order) > 1 ? 'products' : 'product' }}
            </td>
            <td class="px-6 py-3 whitespace-nowrap text-center">
                @include('components.order.statuses', ['status' => $order->order_status, 'class' => 'py-1 px-2 mb-1'])
            </td>
            <td class="px-6 py-3 whitespace-nowrap text-center">
                @include('components.order.ax-statuses', ['status' => $order->ax_status, 'class' => 'py-1 px-2 mb-1'])
            </td>
            <td class="px-6 py-3 whitespace-nowrap text-center">
              @if(isset($order->salesman))
                {{ $order->salesman->name }}
              @else
                <span class="text-gray-300">Óúthlutað</span>
              @endif
            </td>
            <td class="px-6 py-3 whitespace-nowrap">
              {{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y. H:s') }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
@endsection
