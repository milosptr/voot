@extends('layouts.master-admin')

@section('title', 'Dashboard Voot')

@php
    $isManager = auth()
        ->user()
        ->isManager();
    if ($isManager) {
        $accounts = auth()
            ->user()
            ->getSubAccountsAttribute();
        $orders = auth()
            ->user()
            ->getGroupedOrders();
    } else {
        $accounts = [];
        $orders = auth()
            ->user()
            ->orders()
            ->orderBy('id', 'DESC')
            ->limit(8)
            ->get();
    }
@endphp

@section('content')
    <section>
        <h1 class="text-xl font-semibold text-gray-900 mr-auo mb-6">{{ __('backoffice.last_4_orders') }}</h1>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            @foreach ($orders->filter(function ($i) {
            return $i['user_id'] == auth()->user()->id;
        }) as $order)
                <a href="/app/orders/{{ $order['id'] }}" class="bg-white rounded-md shadow border border-gray-100 px-6 py-3">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold text-primary-light tracking-wider text-sm">
                            #{{ $order['id'] }}
                        </div>
                        <div class="">
                            @include('components.order.statuses', [
                                'status' => $order['order_status'],
                                'class' => 'py-1 px-2',
                            ])
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mt-3">
                        <span class="font-medium">{{ __('backoffice.products') }}:</span> {{ count($order['order']) }}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <span class="font-medium">{{ __('backoffice.order_created') }}:</span> <span
                            class="format-the-date">{{ $order['created_at'] }}</span>
                    </div>
                </a>
            @endforeach
        </div>
        @if (auth()->user()->isManager())
            @foreach ($accounts as $account)
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex gap-3 items-center mt-12 mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">
                            Account: {{ $account->name }}
                        </h2>
                        <div class="">
                            ({{ $account->getCustomerShippingAddress() }})
                        </div>
                        <div class="ml-auto">
                            <div class="cursor-pointer text-primary-lighter" onclick="orderForUser({{ $account->id }})">
                                Order for this account</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                        @php
                            $filteredOrders = $orders->filter(function ($i) use ($account) {
                                return $i['user_id'] == $account->id;
                            });
                            $lastFourOrders = $filteredOrders->slice(-4);
                        @endphp
                        @foreach ($lastFourOrders as $order)
                            <a href="/app/orders/{{ $order['id'] }}"
                                class="bg-white rounded-md shadow border border-gray-100 px-6 py-3">
                                <div class="flex justify-between items-center">
                                    <div class="font-semibold text-primary-light tracking-wider text-sm">
                                        #{{ $order['id'] }}
                                    </div>
                                    <div class="">
                                        @include('components.order.statuses', [
                                            'status' => $order['order_status'],
                                            'class' => 'py-1 px-2',
                                        ])
                                    </div>
                                </div>
                                <div class="text-sm text-gray-600 mt-3">
                                    <span class="font-medium">{{ __('backoffice.products') }}:</span>
                                    {{ count($order['order']) }}
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">{{ __('backoffice.order_created') }}:</span> <span
                                        class="format-the-date">{{ $order['created_at'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
        <div class="flex gap-4 items-center mt-12 mb-6">
            <h1 class="text-xl font-semibold text-gray-900">{{ __('backoffice.last_4_favourties') }}</h1>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            @foreach (auth()->user()->favourites()->limit(4)->get() as $product)
                <a href="{{ $product->productUrl }}" target="_blank"
                    class="bg-white rounded-md shadow border border-gray-100 px-6 py-3 grid grid-cols-1 sm:grid-cols-2 justify-between items-center">
                    <div class="w-20 h-20 bg-contain bg-center bg-no-repeat rounded-md"
                        style="background-image: url('/{{ $product->featured_image ? $product->featured_image->file_path : 'images/product-placeholder.png' }}');">
                    </div>
                    <h4 class="font-medium text-sm text-gray-800">
                        {{ $product->translatedName }}
                    </h4>
                </a>
            @endforeach
        </div>
    </section>

    <script>
        function orderForUser(id) {
            document.cookie = `order_for_user=${id};path=/`;
            window.location.href = '/vorur';
        }
    </script>
@endsection
