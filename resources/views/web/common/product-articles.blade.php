<div class="grid grid-cols-2 {{ isset($cols) ? "sm:grid-cols-$cols" : 'sm:grid-cols-4'}} gap-6 gap-b-6">
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
