@extends('layouts.master-admin')

@section('title', 'Inventory')

@section('content')
@section('page-title', 'Inventory')
<section class="">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table id="inventory-table" class="min-w-full divide-y divide-gray-200 overflow-x-scroll">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              n
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              SKU
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Variant
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($inventory as $item)
            <tr>
              <td class="px-6 py-1 text-left text-sm">{{ $loop->index }}</td>
              <td class="px-6 py-1 text-left text-sm">{{ $item->name }}</td>
              <td class="px-6 py-1 text-left text-sm">{{ $item->sku }}</td>
              <td class="px-6 py-1 text-left text-sm">{{ $item->variant }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
@endsection
