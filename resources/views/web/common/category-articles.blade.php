<div class="grid grid-cols-2 sm:grid-cols-4 gap-6 gap-b-6">
  @foreach($categories as $cat)
    <article class="single-article-category" style="order: {{$cat->order}};">
      <a href="/{{ $cat->slug }}" class="block">
        <div
          class="w-full {{ isset($ratio) ? $ratio : 'aspect-w-4 aspect-h-5' }} rounded-md border-gray-100 border-2"
        >
        <div class="w-5/6 h-5/6 m-auto bg-contain bg-center bg-no-repeat rounded-md" style="background-image: url('/{{ $cat->image ? $cat->image->file_path : 'images/product-placeholder.png' }}')"></div>
        </div>
        <h4 class="font-medium text-center mt-3 text-gray-800">
          {{ $cat->translatedName }}
        </h4>
      </a>
    </article>
  @endforeach
</div>
