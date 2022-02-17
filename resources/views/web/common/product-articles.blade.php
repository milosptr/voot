<div class="grid grid-cols-3 {{ isset($cols) ? "sm:grid-cols-$cols" : 'sm:grid-cols-4'}} gap-6 gap-b-6">
  @foreach($products as $product)
    <article class="single-article-product">
      <a href="{{ $product->productUrl }}" class="block">
        <div
          class="w-full {{ isset($ratio) ? $ratio : 'aspect-w-4 aspect-h-5' }} {{ isset($bg) ? $bg : '' }} rounded-md border-gray-100 border-2"
        >
        <div class="w-5/6 h-5/6 m-auto bg-contain bg-center bg-no-repeat rounded-md" style="background-image: url('/{{ $product->featured_image ? $product->featured_image->file_path : 'images/product-placeholder.png' }}')"></div>
        </div>
        <h4 class="font-medium text-center mt-3 text-gray-800">
          {{ $product->name }}
        </h4>
      </a>
    </article>
  @endforeach
</div>
