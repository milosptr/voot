<tr onclick="window.open('/backend/products/edit/{{ isset($product->product_id) ? $product->product_id : $product->id }}')" class="cursor-pointer hover:bg-gray-50">
  <td class="px-6 py-4 whitespace-nowrap">
    <div class="flex items-center">
      <div class="h-10 w-10 rounded-md bg-center bg-contain bg-no-repeat" style="background-image: url('/{{ $product->featuredImage !== null ? $product->featuredImage->file_path : 'images/product-placeholder.png' }}')"></div>
    </div>
  </td>
  <td class="px-6 py-4 whitespace-nowrap">
    <div class="text-sm font-medium text-gray-900">
      {{ $product->name }}
    </div>
  </td>
  <td class="px-6 py-4 whitespace-nowrap">
    {{ $product->sku }}
  </td>
  <td class="px-6 py-4 whitespace-nowrap">
    @foreach($product->categories as $cat)
      <div class="text-xs text-gray-900">
        {{ $cat['name'] }}
      </div>
    @endforeach
  </td>
  <td class="px-6 py-4 whitespace-nowrap">
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full  {{ $product->available ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} ">
      {{ $product->available ? 'Active' : 'Inactive' }}
    </span>
  </td>
  {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    {{ $product->quantity }}
  </td>
  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    {{ $product->price }} isk
  </td> --}}
</tr>
