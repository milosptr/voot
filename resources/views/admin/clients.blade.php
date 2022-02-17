@extends('layouts.master-admin')

@section('title', 'Settings')

@section('content')
@section('page-title', 'Clients')
@section('button')
  <div class="relative ml-auto w-1/4">
    <input type="text" id="clients-search" value="{{ isset($_GET['s']) ? $_GET['s'] : '' }}" name="search" placeholder="Type to search..."
    class="w-full group px-3 pl-10 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent" />
    <div class="text-gray-500 absolute left-0 top-0 mt-2 ml-2">
      @include('components.icons.search')
    </div>
  </div>
@endsection
  <section class="">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              n
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Full name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              KEY ID
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Address
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Phone
            </th>
          </tr>
        </thead>
        <tbody id="client-list" class="bg-white divide-y divide-gray-200">
          @foreach($customers as $customer)
            <tr onclick="window.open('/backend/settings/clients/{{ $customer->id }}')" class="cursor-pointer hover:bg-gray-50">
              <td class="px-6 py-2 whitespace-nowrap">
                {{ $loop->iteration }}.
              </td>
              <td class="px-6 py-2 whitespace-nowrap font-medium text-gray-700">
                {{ $customer->name }}
              </td>
              <td class="px-6 py-2 whitespace-nowrap font-medium">
                #{{ $customer->key }}
              </td>
              <td class="px-6 py-2 whitespace-nowrap">
                {{ $customer->city }} {{ isset($customer->zip) ? $customer->zip .', ' : '' }} {{ $customer->country }}
              </td>
              <td class="px-6 py-2 whitespace-nowrap">
                {{ $customer->phone }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
@endsection
