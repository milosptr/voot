@foreach ($customers as $key => $customer)
    <tr onclick="window.open('/backend/settings/clients/{{ $customer->id }}')"
        class="cursor-pointer hover:bg-gray-50 text-sm">
        <td class="px-6 py-2 whitespace-nowrap">
            {{ $loop->iteration }}.
        </td>
        <td class="px-6 py-2 whitespace-nowrap font-semibold text-gray-700">
            {{ $customer->name }}
        </td>
        <td class="px-6 py-2 whitespace-nowrap">
            #{{ $customer->key }}
        </td>
        <td class="px-6 py-2 whitespace-nowrap">
            {{ $customer->ssn }}
        </td>
        <td class="px-6 py-2 whitespace-nowrap">
            {{ $customer->phone }}
        </td>
        <td
            class="px-6 py-2 whitespace-nowrap font-semibold {{ $customer->email_verified_at ? 'text-green-600' : 'text-amber-600' }}">
            {{ $customer->email_verified_at ? 'Verified' : 'Pending' }}
        </td>
    </tr>
@endforeach
