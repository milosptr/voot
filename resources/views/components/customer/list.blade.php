@foreach($customers as $key => $customer)
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
