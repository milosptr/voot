@extends('layouts.master-admin')

@section('title', 'Settings - Add New Client')

@section('content')
@section('page-title', 'Add New Client')
  <form method="POST" action="/api/customer/new" class="flex flex-col sm:flex-row gap-8">
    <div class="w-2/3">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Full name</label>
            <input type="text" name="name" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required="">
          </div>
          <div class="flex flex-col sm:flex-row gap-5 mt-6">
            <div class="w-full">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="email" class="mt-1 block w-full shadow-sm sm:text-sm rounded-md border-gray-300" required="">
            </div>
            <div class="w-full">
              <label for="invoice_email" class="block text-sm font-medium text-gray-700">Invoice Email</label>
              <input type="text" name="invoice_email" id="invoice_email" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="">
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-5 mt-6">
            <div class="w-full ">
              <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
              <input type="text" name="phone" id="phone" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required="">
            </div>
            <div class="w-full ">
              <label for="key" class="block text-sm font-medium text-gray-700">Customer key</label>
              <input type="text" name="key" id="key" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="" required="">
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-5 mt-6">
          <div class="w-full ">
              <label for="ssn" class="block text-sm font-medium text-gray-700">Customer SSN</label>
              <input type="text" name="ssn" id="ssn" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required="">
            </div>
            <div class="w-full">
              <label for="street" class="block text-sm font-medium text-gray-700">Street</label>
              <input type="text" name="street" id="street" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>
          <div class="flex flex-col sm:flex-row gap-5 mt-6">
            <div class="w-full ">
              <label for="city" class="block text-sm font-medium text-gray-700">City</label>
              <input type="text" name="city" id="city" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="w-full">
              <label for="zip" class="block text-sm font-medium text-gray-700">ZIP</label>
              <input type="text" name="zip" id="zip" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="w-full ">
              <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
              <input type="text" name="country" id="country" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="IS" readonly>
            </div>
          </div>
          <div class="flex flex-wrap mt-10">
            <button type="submit" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Crate Client</button>
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
