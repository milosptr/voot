@extends('layouts.master-admin')

@section('title', 'Sent Emails')

@section('page-title', 'Sent Emails')
@section('content')
  <style>
    [aria-current="page"] span {
      background: rgba(132, 190, 255, 0.25);
      color: #1d68a7;
    }
  </style>
  <section>
    @if(!empty(Session::get('status')))
      <div class="border-l-4 border-green-400 bg-green-100 p-4 mb-10 shadow-sm">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path style="color: rgb(34, 197, 94);" fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" fill="currentColor" />
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
    @if(!empty(Session::get('ERROR')))
      <div class="rounded-md bg-red-50 shadow-sm border border-red-100 p-4 mb-10">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="text-sm ml-3 text-red-700">
            {{ Session::get('ERROR') }}
          </div>
        </div>
      </div>
    @endif
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">To</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Remark</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Order ID</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Sent at</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Created at</th>
                  <th scope="col" class="whitespace-nowrap px-4 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                </tr>
              </thead>
              <tbody id="sent-emails-tbody" class="divide-y divide-gray-200 bg-white">
                @foreach($emails as $email)
                  <tr data-key="{{$email->id}}">
                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">{{$email->id}}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $email->to }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900 truncate w-32">{{ $email->remark }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">#{{ $email->order_id }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm  {{ $email->sent_at ? 'text-primary-lighter' : 'text-red-500' }}">{{ $email->sent_at ?: 'Not sent' }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm {{ $email->type === 1 ? 'text-primary-lighter' : 'text-gray-700' }}">{{ $email->type === 1 ? 'Customer' : 'Salesman' }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ $email->created_at }}</td>
                    <td class="whitespace-nowrap text-sm px-3 text-gray-500">
                      <a href="/api/resend-email/{{$email->id}}">
                        @php
                          $createdAt = Carbon\Carbon::parse($email->created_at);
                          $now = Carbon\Carbon::now()->subMinutes(2);
                          $animationClass = $createdAt->greaterThanOrEqualTo($now) ? 'rotate-360-infinite' : '';
                        @endphp

                        @if($createdAt->greaterThanOrEqualTo($now))
                          <script>
                            setTimeout(() => {
                              window.location.reload()
                            }, {{ $createdAt->diffInSeconds($now) }} * 1000)
                          </script>
                        @endif
                        <div class="{{ $animationClass }}">
                          <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        </div>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-10">
      {{ $emails->links() }}
    </div>
</section>
@endsection
