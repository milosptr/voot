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
  <div class="relative ml-2">
    <a href="/backend/settings/clients/new" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center ml-5 px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Create New</a>
  </div>
@endsection
  <section class="">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="min-w-full divide-y divide-gray-200 overflow-x-scroll">
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
              SSN
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Phone
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Status
            </th>
          </tr>
        </thead>
        <tbody id="client-list" class="bg-white divide-y divide-gray-200">
          @include('components.customer.list', ['customers' => $customers])
        </tbody>
      </table>
    </div>
    <div class="mt-10">
      {{ $customers->links() }}
    </div>
  </section>
@endsection
