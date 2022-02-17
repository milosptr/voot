<label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
<select id="{{ $id }}" name="{{ $id }}" class="mt-2 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
  @if($showAll)
    <option value='' {{ !$selected_category ? 'selected' : '' }} disabled="{{ $disableFirst }}">All categories</option>
  @endif
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
