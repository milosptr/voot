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
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($emails as $email)
                  <tr>
                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">{{$email->id}}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $email->to }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900 truncate w-32">{{ $email->remark }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">#{{ $email->order_id }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm  {{ $email->sent_at ? 'text-primary-lighter' : 'text-red-500' }}">{{ $email->sent_at ?: 'Not sent' }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm {{ $email->type === 1 ? 'text-primary-lighter' : 'text-gray-700' }}">{{ $email->type === 1 ? 'Customer' : 'Salesman' }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ $email->created_at }}</td>
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
