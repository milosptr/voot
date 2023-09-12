@extends('layouts.master-admin')

@section('title', 'Edit Customer')

@section('content')
@section('page-title', 'Edit customer')
<section>
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
    @if (str_contains($customer->email, ';'))
        <div class="rounded-md bg-red-50 shadow-sm border border-red-100 p-4 mb-10">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Heroicon name: mini/x-circle -->
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">This user has invalid email!</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul role="list" class="list-disc space-y-1 pl-5">
                            <li>You can add only <strong>one</strong> and <strong>unique</strong> email in this field
                            </li>
                            <li>Multiple emails should go into <strong>Invoice Email</strong> field</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="/api/customer/{{ $customer->id }}" class="flex flex-col sm:flex-row gap-8">
        <div class="w-2/3">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Full name</label>
                        <input type="text" name="name" id="title"
                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            value="{{ $customer->name }}" required="">
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 mt-6">
                        <div class="w-full">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="mt-1 block w-full shadow-sm sm:text-sm rounded-md {{ str_contains($customer->email, ';') ? 'border-red-400' : 'border-gray-300' }}"
                                value="{{ $customer->email }}" required="">
                        </div>
                        <div class="w-full">
                            <label for="invoice_email" class="block text-sm font-medium text-gray-700">Invoice
                                Email</label>
                            <input type="text" name="invoice_email" id="invoice_email"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->invoice_email }}">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 mt-6">
                        <div class="w-full ">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->phone }}" required="">
                        </div>
                        <div class="w-full ">
                            <label for="key" class="block text-sm font-medium text-gray-700">Customer key</label>
                            <input type="text" name="key" id="key"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->key }}" required="">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 mt-6">
                        <div class="w-full ">
                            <label for="ssn" class="block text-sm font-medium text-gray-700">Customer SSN</label>
                            <input type="text" name="ssn" id="ssn"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->ssn }}" required="">
                        </div>
                        <div class="w-full">
                            <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
                            <input type="text" name="street" id="street"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->street }}">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 mt-6">
                        <div class="w-full ">
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" name="city" id="city"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->city }}">
                        </div>
                        <div class="w-full">
                            <label for="zip" class="block text-sm font-medium text-gray-700">ZIP</label>
                            <input type="text" name="zip" id="zip"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->zip }}">
                        </div>
                        <div class="w-full ">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" name="country" id="country"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->country }}">
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-5 mt-6">
                        <div class="sm:w-1/2 mt-6">
                            <label for="country" class="block text-sm font-medium text-gray-700">Default
                                shipping</label>
                            <select name="default_shipping_id"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->default_shipping_id }}">
                                <option value="null" readonly disabled>Choose shipping</option>
                                @foreach ($shippingMethods as $method)
                                    <option value="{{ $method->id }}"
                                        {{ $customer->default_shipping_id === $method->id ? 'selected' : '' }}>
                                        {{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:w-1/2 mt-6">
                            <label for="manager" class="block text-sm font-medium text-gray-700">Is this account a
                                manager? {{ $customer->manager }}</label>
                            <select name="manager"
                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="{{ $customer->manager }}">
                                <option value="0" {{ $customer->manager === 0 ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $customer->manager === 1 ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-10">
                        <button type="submit"
                            class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Save
                            changes</button>
                        <a href="/api/customer/{{ $customer->id }}/reset-password"
                            class="ml-auto text-center text-gray-600 border border-gray-200 px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer">
                            Reset Password
                        </a>
                        @if ($customer->email_verified_at === null)
                            <a href="/api/customer/{{ $customer->id }}/verify"
                                class="ml-3 text-center text-green-600 border border-green-400 px-6 py-2 text-sm font-normal rounded-md hover:bg-green-500 hover:border-green-500 hover:text-white cursor-pointer">
                                Verify
                            </a>
                        @endif
                        <a href="/api/customer/{{ $customer->id }}/delete"
                            class="ml-3 text-center text-red-500 border border-red-500 px-6 py-2 text-sm font-normal rounded-md hover:bg-red-500 hover:text-white cursor-pointer">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/3">
            <div id="upload-customer-logo" data-key="{{ $customer->id }}"></div>
        </div>
    </form>
</section>
@endsection
