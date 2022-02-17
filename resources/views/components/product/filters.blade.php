@php
$selected_category = isset($_GET['category']) ? $_GET['category'] : 0;
@endphp
<div class="flex items-end mb-10">
  <div>
    <label for="products-category-filter" class="block text-sm font-medium text-gray-700">Filter by category</label>
    <select id="products-category-filter" name="location" class="mt-2 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      <option value='' {{ !$selected_category ? 'selected' : '' }}>All categories</option>
      @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ $cat->id == $selected_category ? 'selected' : '' }}>
          {{ $cat->name }}
        </option>
        @foreach($cat->children as $subcategory)
          <option value="{{ $subcategory->id }}" {{ $subcategory->id == $selected_category ? 'selected' : '' }}>
            {{ '— '.$subcategory->name }}
          </option>
          @foreach($subcategory->children as $subsubcategory)
            <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == $selected_category ? 'selected' : '' }}>
              {{ '— —'.$subsubcategory->name }}
            </option>
          @endforeach
        @endforeach
      @endforeach
    </select>
  </div>
  @if(isset($_GET['s']) || isset($_GET['category']))
  <div class="ml-auto">
    <a
      href="/backend/products"
      class="border border-gray-400 text-gray-600 group flex items-center ml-5 px-6 py-2 text-sm font-normal rounded-md hover:text-white hover:bg-gray-400"
    >
      Clear Filters
    </a>
  </div>
  @endif
</div>
