@extends('layouts.master-admin')

@section('title', 'Sótt um lykilorð')

@section('page-title', 'Sótt um lykilorð')
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
                  <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Done</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">SSN</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Simi</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Company</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Company ssn</th>
                  <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Created at</th>
                </tr>
              </thead>
              <tbody id="sent-emails-tbody" class="divide-y divide-gray-200 bg-white">
                @foreach($requests as $account)
                <tr>
                  <td class="px-2 py-2 pl-6">
                    <div class="flex h-5 items-center">
                      <input aria-describedby="comments-description" name="finished" {{ $account->finished ? 'checked' : ''}} type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" onclick="finishAccountRequest({{$account->id}})">
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->name }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->ssn }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">
                    {{ $account->email }}<br>{{ $account->invoice_email }}
                  </td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->phone }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->company }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->company_ssn }}</td>
                  <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ $account->created_at }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-10">
      {{ $requests->links() }}
    </div>
</section>

<script>
  function finishAccountRequest(id) {
    fetch(`/api/account-request/${id}/finish`)
  }
</script>
@endsection
