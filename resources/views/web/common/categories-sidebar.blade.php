@foreach($categories as $category)
  @php $catSlug = Request::segment(1); @endphp
  <div class="py-4 font-medium border-b border-gray-200 text-gray-600 tracking-wide {{ isset($category->order) ? 'order-'.$category->order : 'order-last' }}">
    <div class="flex justify-between items-center w-full">
      <a href="/{{$category->slug}}" class="w-full flex items-center gap-3 font-medium text-gray-800 hover:text-primary-lighter {{ $catSlug === $category->slug ? 'text-primary-lighter font-medium' : '' }}">
       <img src="/images/categories/{{ $category->slug }}.svg" alt="{{ $category->slug }}" width="30" />
       <span>{{ $category->translatedName }}</span>
      </a>
      @if($category->children->isNotEmpty())
        <svg xmlns="http://www.w3.org/2000/svg" data-open-subcategory="{{ $category->slug }}" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-half cursor-pointer"><polyline points="6 9 12 15 18 9"/></svg>
      @endif
      @php
        $isOpen = $category->isActiveCategory($category, $catSlug);
      @endphp
    </div>
    @if($category->children->isNotEmpty())
      <div class="max-h-0 sub-categories main-sub-categories overflow-hidden {{ $isOpen ? 'categories-sidebar-opened' : '' }}" data-subcategory="{{ $category->slug }}">
        @foreach($category->children as $subcat)
          @php
           $subcatClass = $catSlug === $subcat->slug ? 'text-primary-lighter font-medium' : '';
           $isOpen = $category->isActiveCategory($subcat, $catSlug);
          @endphp
          <div class="flex items-center justify-between text-gray-500">
            <a href="/{{ $subcat->slug }}" class="w-full block py-2 text-gray-500 hover:text-primary-lighter {{ $subcatClass }}" data-cat-slug="">{{ $subcat->translatedName }}</a>
            @if($subcat->children->isNotEmpty())
            <svg xmlns="http://www.w3.org/2000/svg" data-open-subcategory="{{ $subcat->slug }}" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-half cursor-pointer"><polyline points="6 9 12 15 18 9"/></svg>
            @endif
          </div>
          <div class="max-h-0 sub-categories overflow-hidden transition-half {{ $isOpen ? 'categories-sidebar-opened' : '' }}" data-subcategory="{{ $subcat->slug }}">
            <div class="pl-4 my-3">
              @foreach($subcat->children as $subsubcat)
                <a href="/{{ $subsubcat->slug }}" class="w-full block py-2 text-gray-500 hover:text-primary-lighter {{ $catSlug === $subsubcat->slug ? 'text-primary-lighter font-medium' : '' }}">{{ $subsubcat->translatedName }}</a>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endforeach
