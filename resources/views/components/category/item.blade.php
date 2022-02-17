
<tr data-category="{{ $category->name }}" class="cursor-pointer hover:bg-gray-50">
  <td class="w-8 px-6 py-2 whitespace-nowrap {{ 'pl-'. $ischild * 6 }}">
    @if($category->parent_id)
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#454545" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="60" cy="60" r="8"></circle><circle cx="128" cy="60" r="8"></circle><circle cx="196" cy="60" r="8"></circle><circle cx="60" cy="128" r="8"></circle><circle cx="128" cy="128" r="8"></circle><circle cx="196" cy="128" r="8"></circle><circle cx="60" cy="196" r="8"></circle><circle cx="128" cy="196" r="8"></circle><circle cx="196" cy="196" r="8"></circle></svg>
    @endif
  </td>
  <td class="w-12 px-6 py-2 whitespace-nowrap">
    <div class="w-10 h-10 rounded-full bg-center bg-cover bg-no-repeat" style=" {{ isset($category->image) ? 'background-image: url(/'.$category->image->file_path.');' : 'background: #eee' }}"></div>
  </td>
  <td class="px-6 py-2 whitespace-nowrap">
    <div class="font-medium text-gray-700">
      {{ $category->name }}
    </div>
    <div class="text-xs font-light text-gray-400">
      {{ env('APP_URL') }}/{{ $category->slug }}
    </div>
  </td>
  <td class="text-center py-2 whitespace-nowrap">
    @if($category->available)
      <span class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-green-100 text-green-800">
        Available
      </span>
    @else
        <span class="px-2 inline-flex text-xs leading-5 tracking-wide font-normal rounded-full bg-gray-100 text-gray-800">
          Unavailable
        </span>
    @endif
  </td>
  <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-500">
      {{ count($category->products) }} products
  </td>
  <td class="w-8 px-6 py-2 whitespace-nowrap">
    <div class="flex items-center">
      <a href="/backend/categories/edit/{{ $category->id }}" class="flex items-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
      </a>
      <div class="ml-5 flex items-center justify-center">
        <div data-id="{{ $category->id }}" data-name="{{ $category->name }}" class="delete-product-btn w-5 h-5 cursor-pointer flex items-center relative">
        </div>
      </div>
    </div>
  </td>
</tr>
