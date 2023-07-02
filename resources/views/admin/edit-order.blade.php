@extends('layouts.master-admin')

@section('title', 'Edit Order')

@section('backbutton')
    <a href="/backend/orders" class="text-pprimary-light group flex items-center px-4 py-2 text-sm font-normal rounded-md">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
    </a>
@endsection
@section('content')
@section('page-title', 'Edit Order')
@if (!empty(Session::get('status')))
    <div class="border-l-4 border-green-400 bg-green-100 p-4 mb-10 shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path style="color: rgb(34, 197, 94);" fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" fill="currentColor" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">
                    {{ Session::get('status') }}
                </p>
            </div>
        </div>
    </div>
@endif
@if (!empty(Session::get('ERROR')))
    <div class="rounded-md bg-red-50 shadow-sm border border-red-100 p-4 mb-10">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="text-sm ml-3 text-red-700">
                {{ Session::get('ERROR') }}
            </div>
        </div>
    </div>
@endif
<section class="flex flex-col sm:flex-row gap-8">
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="/api/request-order/update/{{ $order->id }}" method="POST" class="flex flex-wrap">
                <div class="w-full sm:w-3/4 sm:pr-4">
                    <label for="order_salesman" class="block text-sm font-medium text-gray-500">Sölumaður</label>
                    <select id="order_salesman" name="salesman_id"
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md">
                        <option value="">Óúthlutað</option>
                        @foreach (App\Models\User::where('role', 'admin')->get() as $key => $user)
                            <option value="{{ $user->id }}"
                                {{ $order->salesman_id === $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full sm:w-1/4 sm:pl-4">
                    <label for="order_salesman" class="block text-sm font-medium text-gray-500">AX senda aftur</label>
                    <div id="openResendAXOrderModal"
                        class="mt-1 cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-3 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
                        Senda aftur
                    </div>
                </div>
                <div class="w-full h-1 border-b border-gray-200 pb-3 mb-3"></div>
                <div class="w-full flex items-center justify-between">
                    <div class="w-full">
                        <label for="order_status" class="block text-sm font-medium text-gray-500">Staða pöntunar</label>
                        @include('components.order.statuses', ['status' => $order->order_status])
                    </div>
                    <div class="w-full sm:pl-4">
                        <label for="status" class="block text-sm font-medium text-gray-500">Breyta stöðu</label>
                        <select id="status" name="order_status"
                            class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md">
                            @foreach (App\Models\Order::statuses() as $key => $status)
                                <option value="{{ $key }}"
                                    {{ $order->order_status === $key ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:pr-4 mt-4">
                    <label for="created_at" class="block text-sm font-medium text-gray-500">Sótt um þann</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y. H:s') }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 sm:pl-4 mt-4">
                    <label for="updated_at" class="block text-sm font-medium text-gray-500">Síðast uppfært þann</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ Carbon\Carbon::parse($order->updated_at)->format('d.m.Y. H:s:i') }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mt-4 sm:pr-4 select-none">
                    <label for="customer" class="block text-sm font-medium text-gray-500">Nafn viðskiptavinar</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ $order->user->name }}
                    </div>
                </div>
                <div class="w-full mt-4 sm:w-1/2 sm:pl-4 select-none">
                    <label for="title" class="block text-sm font-medium text-gray-500">Kennitala
                        viðskiptavinar</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ $order->user->ssn ?? 'None' }}
                    </div>
                </div>
                <div class="w-full sm:w-1/2 mt-4 sm:pr-4 select-none">
                    <label for="email" class="block text-sm font-medium text-gray-500">Tölvupóstur
                        viðskiptavinar</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ $order->user->email }}
                    </div>
                </div>
                <div class="w-full mt-4 sm:w-1/2 sm:pl-4 select-none">
                    <label for="invoice_email" class="block text-sm font-medium text-gray-500">Tölvupóstur fyrir
                        reikninga</label>
                    <div
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                        {{ $order->user->invoice_email ?? 'None' }}
                    </div>
                </div>
                <div class="w-full sm:w-3/4 mt-4">
                    <label for="shipping_address" class="block text-sm font-medium text-gray-500">Sent til</label>
                    <input type="text" name="shipping_address" id="shipping_address"
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
                        value="{{ $order->orderAddress() }}" required="">
                </div>
                <div class="w-full sm:w-1/3 sm:pr-4 mt-4">
                    <label for="order_id" class="block text-sm font-medium text-gray-500">Númer pöntunar</label>
                    <input type="text" name="order_id" id="order_id"
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
                        placeholder="{{ $order->id }}" value="{{ $order->order_id }}">
                </div>
                <div class="w-full sm:w-1/3 mt-4 sm:px-4">
                    <label for="shipping_address"
                        class="block text-sm font-medium text-gray-500">Sendingaraðferð</label>
                    <input type="text" name="shipping_method_code" id="shipping_method_code"
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
                        value="{{ $shippingMethod->name }}" readonly disabled>
                </div>
                <div class="w-full sm:w-1/3 sm:pl-4 mt-4">
                    <label for="shipping_date" class="block text-sm font-medium text-gray-500">Dagsetning
                        sendingar</label>
                    <input type="date" name="shipping_date" id="shipping_date"
                        class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-gray-200 rounded-md"
                        value="{{ Carbon\Carbon::parse($order->shipping_date)->format('Y-m-d') }}" required="">
                </div>
                @if ($order->note)
                    <div class="w-full mt-4">
                        <label for="title" class="block text-sm font-medium text-gray-500">Athugasemd
                            viðskiptavinar</label>
                        <div
                            class="mt-1 block w-full shadow-sm sm:text-sm py-2 px-4 border-1 border-gray-200 text-gray-400 rounded-md">
                            {{ $order->note }}
                        </div>
                    </div>
                @endif
                <div class="w-full flex items-center gap-5 mt-8">
                    <button type="submit"
                        class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
                        Uppfærðu röð
                    </button>
                    <div id="openNotifyCustomerModal"
                        class="cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
                        Látið viðskiptavin vita
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="w-1/2 bg-white overflow-hidden shadow rounded-lg relative">
        <div class="px-4 py-5 sm:p-6">
            <h2 class="text-sm font-medium text-gray-500 border-b border-gray-200 pb-6">Panta</h2>
            <div id="edit-order" data-order="{{ $order->id }}"></div>
        </div>
    </div>
</section>

<section id="order-history">
    <div class="container">
        <div class="">
            <div class="text-gray-500 mt-12 mb-2">Saga</div>
            <div class="history-box overflow-hidden" style="height:0;">
                @foreach ($order->activityLog as $log)
                    <div class="text-xs text-gray-400 mb-2">
                        <span class="text-gray-500">{{ isset($log->user) ? $log->user->name : '/' }} at
                            {{ Carbon\Carbon::parse($log->created_at)->format('m/d/Y H:m:s') }} </span>
                        <br>
                        <span class="tracking-wide">
                            {{ str_replace('}', '', str_replace('{', '', $log->from)) }}</span>
                        <br>
                        <span class="tracking-wide"> {{ str_replace('}', '', str_replace('{', '', $log->to)) }}</span>
                    </div>
                @endforeach
            </div>
            <div
                class="show-history-btn inline-block px-4 py-1 text-xs bg-gray-200 border border-gray-300 rounded-md cursor-pointer text-gray-500 uppercase tracking-wide">
                Sýna sögu
            </div>
        </div>
    </div>
</section>

<div id="notifyCustomerModal" class="fixed left-0 top-0 w-full h-screen flex items-center justify-center hidden">
    <div class="bg-gray-900 opacity-50 absolute left-0 top-0 z-20 w-full h-screen"></div>
    <form action="/api/orders/{{ $order->id }}/notify" method="POST"
        class="w-full sm:w-1/2 bg-white rounded-md p-5 z-30">
        <div class="text-lg font-medium text-black">Láta viðskiptavininn vita (valfrjálst)</div>
        <div class="text-sm text-gray-500">Skrifaðu textann sem verður innifalinn í tölvupóstinum</div>
        <div class="mt-3">
            <textarea rows="4" name="remarks" id="remarks"
                class="block w-full rounded-md resize-none border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between mt-3">
            <div id="closeNotifyCustomerModal"
                class="cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
                Hætta við
            </div>
            <button type="submit"
                class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
                Senda tölvupóst
            </button>
        </div>
    </form>
</div>

<div id="resendAXOrderModal" class="fixed left-0 top-0 w-full h-screen flex items-center justify-center hidden">
    <div class="bg-gray-900 opacity-50 absolute left-0 top-0 z-20 w-full h-screen"></div>
    <form action="/api/resend-ax-order/{{ $order->id }}" method="POST"
        class="w-full sm:w-1/2 bg-white rounded-md p-5 z-30">
        <div class="text-lg font-medium text-black">Sendu pöntun aftur</div>
        <div class="text-sm text-gray-500">Sendu þessa pöntun aftur til AX kerfisins.</div>
        <div class="flex flex-col sm:flex-row items-center justify-between mt-10">
            <div id="closeResendAXOrderModal"
                class="cursor-pointer text-gray-700 border border-gray-400 flex justify-center items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-500 hover:text-white">
                Hætta við
            </div>
            <button type="submit"
                class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">
                Senda aftur
            </button>
        </div>
    </form>
</div>
@endsection
