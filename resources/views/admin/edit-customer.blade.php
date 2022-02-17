@extends('layouts.master-admin')

@section('title', 'Edit Customer')

@section('content')
@section('page-title', 'Edit customer')
  <section>
    <form method="POST" action="/api/customer/{{ $customer->id }}" class="flex flex-col sm:flex-row gap-8">
      <div class="w-2/3">
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Full name</label>
              <input type="text" name="name" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->name }}" required="">
            </div>
            <div class="flex flex-col sm:flex-row gap-5 mt-6">
              <div class="w-full">
                <label for="title" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="text" name="email" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->email }}" required="">
              </div>
              <div class="w-full">
                <label for="title" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->phone }}">
              </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-5 mt-6">
              <div class="w-full ">
                <label for="title" class="block text-sm font-medium text-gray-700">Customer key</label>
                <input type="text" name="key" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->key }}" required="">
              </div>
              <div class="w-full ">
                <label for="title" class="block text-sm font-medium text-gray-700">Customer SSN</label>
                <input type="text" name="ssn" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->ssn }}" required="">
              </div>
            </div>
            <div class="mt-6">
              <label for="title" class="block text-sm font-medium text-gray-700">Street</label>
              <input type="text" name="street" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->street }}">
            </div>
            <div class="flex flex-col sm:flex-row gap-5 mt-6">
              <div class="w-full ">
                <label for="title" class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="city" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->city }}">
              </div>
              <div class="w-full">
                <label for="title" class="block text-sm font-medium text-gray-700">ZIP</label>
                <input type="text" name="zip" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->zip }}">
              </div>
              <div class="w-full ">
                <label for="title" class="block text-sm font-medium text-gray-700">Country</label>
                <input type="text" name="country" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $customer->country }}">
              </div>
            </div>
            <div class="flex flex-wrap mt-10">
              <button type="submit" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Save changes</button>
              <a href="/api/customer/{{ $customer->id }}/reset-password" class="ml-auto text-center text-gray-600 border border-gray-200 px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer">
                Reset Password
              </a>
              <a href="/api/customer/{{ $customer->id }}/delete" class="ml-3 text-center text-red-500 border border-red-500 px-6 py-2 text-sm font-normal rounded-md hover:bg-red-500 hover:text-white cursor-pointer">
                Delete
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="w-1/3">
        <div class="bg-white overflow-hidden shadow rounded-lg px-4 py-5 sm:p-6">
          <label for="fileDrop" class="block text-sm font-medium text-gray-700">
          Client logo (automatic upload - no need to save)
          </label>
          <div class="w-1/2 mx-auto mt-2">
            <input id="customer-logo-image" type="file" name="logo" data-key="{{ $customer->id }}" hidden />
            <label for="customer-logo-image" class="block aspect-w-1 aspect-h-1 bg-contain bg-center bg-no-repeat rounded-md cursor-pointer" style="background-image: url('/{{ isset($customer->logo) ? $customer->logo : 'images/file-upload.png' }}');"></label>
          </div>
        </div>
      </div>
    </form>
  </section>
@endsection
