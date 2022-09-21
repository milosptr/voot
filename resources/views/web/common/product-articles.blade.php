<div class="grid grid-cols-2 {{ isset($cols) ? "sm:grid-cols-$cols" : 'sm:grid-cols-4'}} gap-6 gap-b-6">
  @if(isset($favourites))
    @foreach($favourites as $product)
      @php
        $extraStyles = isset($product->subcategory) && $product->subcategory->id == App\Models\Category::SMURSPREY ? 'background-size: 140%;' : '';
      @endphp
      <article class="single-article-product relative">
        <a href="{{ $product->productUrl }}" class="block">
          @if(isset($product->label))
            <div class="absolute left-2 top-2 inline-flex items-center rounded-md bg-red-500 px-2.5 py-0.5 text-sm font-medium text-white z-10 mr-2 break-all">
            {{ $product->label }}
            </div>
          @endif
          @if(isset($product->is_favourite) && $product->is_favourite)
            <div class="absolute right-0 top-2 h-6 w-6 px-2.5 py-0.5 z-10 mr-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M239.2,97.4A16.4,16.4,0,0,0,224.6,86l-59.4-4.1-22-55.5A16.4,16.4,0,0,0,128,16h0a16.4,16.4,0,0,0-15.2,10.4L90.4,82.2,31.4,86A16.5,16.5,0,0,0,16.8,97.4,16.8,16.8,0,0,0,22,115.5l45.4,38.4L53.9,207a18.5,18.5,0,0,0,7,19.6,18,18,0,0,0,20.1.6l46.9-29.7h.2l50.5,31.9a16.1,16.1,0,0,0,8.7,2.6,16.5,16.5,0,0,0,15.8-20.8l-14.3-58.1L234,115.5A16.8,16.8,0,0,0,239.2,97.4Z"></path></svg>
            </div>
          @endif
          <div
            class="w-full {{ isset($ratio) ? $ratio : 'aspect-w-4 aspect-h-5' }} {{ isset($bg) ? $bg : '' }} rounded-md border-gray-100 border-2"
          >
            <div class="w-5/6 h-5/6 m-auto bg-contain bg-center bg-no-repeat rounded-md" style="background-image: url('/{{ $product->featured_image ? $product->featured_image->file_path : 'images/product-placeholder.png' }}'); {{ $extraStyles }}"></div>
          </div>
          <h4 class="font-medium text-center mt-3 text-gray-800">
            {{ $product->translatedName }}
          </h4>
        </a>
      </article>
    @endforeach
  @endif
  @foreach($products as $product)
    @php
      $extraStyles = isset($product->subcategory) && $product->subcategory->id == App\Models\Category::SMURSPREY ? 'background-size: 140%;' : '';
    @endphp
    <article class="single-article-product relative">
      <a href="{{ $product->productUrl }}" class="block">
        @if(isset($product->label))
          <div class="absolute left-2 top-2 inline-flex items-center rounded-md bg-red-500 px-2.5 py-0.5 text-sm font-medium text-white z-10 mr-2 break-all">
           {{ $product->label }}
          </div>
        @endif
        @if(isset($product->is_favourite) && $product->is_favourite)
          <div class="absolute right-0 top-2 h-6 w-6 px-2.5 py-0.5 z-10 mr-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M239.2,97.4A16.4,16.4,0,0,0,224.6,86l-59.4-4.1-22-55.5A16.4,16.4,0,0,0,128,16h0a16.4,16.4,0,0,0-15.2,10.4L90.4,82.2,31.4,86A16.5,16.5,0,0,0,16.8,97.4,16.8,16.8,0,0,0,22,115.5l45.4,38.4L53.9,207a18.5,18.5,0,0,0,7,19.6,18,18,0,0,0,20.1.6l46.9-29.7h.2l50.5,31.9a16.1,16.1,0,0,0,8.7,2.6,16.5,16.5,0,0,0,15.8-20.8l-14.3-58.1L234,115.5A16.8,16.8,0,0,0,239.2,97.4Z"></path></svg>
          </div>
        @endif
        <div
          class="w-full {{ isset($ratio) ? $ratio : 'aspect-w-4 aspect-h-5' }} {{ isset($bg) ? $bg : '' }} rounded-md border-gray-100 border-2"
        >
          <div class="w-5/6 h-5/6 m-auto bg-contain bg-center bg-no-repeat rounded-md" style="background-image: url('/{{ $product->featured_image ? $product->featured_image->file_path : 'images/product-placeholder.png' }}'); {{ $extraStyles }}"></div>
        </div>
        <h4 class="font-medium text-center mt-3 text-gray-800">
          {{ $product->translatedName }}
        </h4>
      </a>
    </article>
  @endforeach
</div>
