@extends('layouts.master-admin')

@section('title', 'Dashboard Voot')

@section('content')
  @php
    $customer = auth()->user();
  @endphp
  @if(request()->get('status'))
  <div class="border-l-4 border-green-400 bg-green-100 p-4 mb-10">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path style="color: rgb(34, 197, 94);" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" fill="currentColor" />
        </svg>
      </div>
      <div class="ml-3">
        <p class="text-sm text-green-700">
          {{ request()->get('status') }}
        </p>
      </div>
    </div>
  </div>
  <script>
    console.log('hello world')
    let url = window.location.href
    let newUrl = url.split('?')[0]
    history.pushState({}, null, newUrl)
  </script>
  @endif
  <section>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900"> {{ __('backoffice.nav_my_account') }}</h3>
      </div>
      <div class="border-t border-gray-200">
        <dl>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.full_name') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $customer->name }}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.email') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $customer->email }}</dd>
          </div>
          <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 items-center">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.invoice_email') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <form action="/api/invoice-email/{{ auth()->user()->id }}" method="POST" class="flex gap-4 items-center">
                <input type="email" name="invoice_email" class="shadow-sm sm:w-64 block sm:text-sm border-gray-300 rounded-md" value="{{ $customer->invoice_email }}" required />
                <button type="submit" tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
                  Save
                </button>
              </form>
            </dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.phone') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $customer->phone }}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.ssn') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $customer->ssn }}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.full_address') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $customer->street }}, {{ $customer->city }} {{ $customer->zip }}, {{ $customer->country }}</dd>
          </div>
          <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 items-center sm:px-6">
            <dt class="text-sm font-medium text-gray-500">{{ __('backoffice.change_password') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <form action="/api/change-password/{{ auth()->user()->id }}" method="POST" class="flex gap-4 items-center">
                <input type="text" name="password" class="shadow-sm sm:w-64 block sm:text-sm border-gray-300 rounded-md" placeholder="Nýtt lykilorð" required />
                <button type="submit" tabindex="0" class="w-32 select-none text-center text-white border border-primary-light bg-primary-light px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-lighter hover:text-white cursor-pointer" @keydown.enter="save" @click="save">
                  Change
                </button>
              </form>
            </dd>
          </div>
        </dl>
      </div>
    </div>
  </section>
@endsection
