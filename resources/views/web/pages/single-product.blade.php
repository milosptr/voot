@extends('layouts.default')

@section('title', $product->name)

@section('content')
<section id="single-product">
  <div class="container mx-auto">
    <div class="py-2 mt-12">
      <a href="/{{ $product->categories->first()->slug }}" class="text-pprimary-light group flex items-center py-2 text-sm font-normal rounded-md text-gray-700">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        <div class="">Back to categories</div>
      </a>
    </div>
    <div class="py-2 mt-3 flex flex-wrap justify-between">
      <div class="w-2/5 pr-8">
        <div class="single-product-gallery relative">
          <div id="single-product-bigimage" class="w-full aspect-w-1 aspect-h-1 single-product-gallery--big rounded-md border border-gray-100 shadow-sm">
            <div class="h-full bg-contain bg-center bg-no-repeat rounded-md single-product-bigimage-url" data-zoom="/{{ isset($product->featuredImage) ? $product->featuredImage->file_path : 'images/product-placeholder.png' }}" style="background-image: url('/{{ isset($product->featuredImage) ? $product->featuredImage->file_path : 'images/product-placeholder.png' }}')"></div>
          </div>
          <div class="drift-zoom-pane"></div>
          <div id="single-product-gallery" class="flex items-center gap-4 overflow-hidden mt-4">
            @foreach ($product->media as $media)
              <div class="w-32 h-32 rounded-md  border border-gray-100 shadow-sm">
                <div class="h-full bg-center bg-contain bg-no-repeat cursor-pointer" style="background-image: url('/{{ $media->file_path }}')" data-image="/{{ $media->file_path }}"></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="w-1/2">
        <h1 class="text-gray-800 text-4xl font-bold">
          {{ $product->name }}
        </h1>
        @if($product->species)
          <div class="mt-2 font-light text-sm flex items-center">
            <div class="mr-1 text-gray-700">{{ __('Latin: ') }}</div>
            <div class="text-primary-light font-light italic">{{ $product->species }}</div>
          </div>
        @endif
        <div class="single-product-description mt-3 pt-3 text-base text-gray-600 font-light border-t border-gray-200">
          {!! $product->description !!}
        </div>
        <div class="mt-3 text-sm font-light flex items-center pt-2 border-t border-gray-200">
          <div class="mr-1 text-gray-700">{{ count($product->categories) > 1 ? 'Categories: ' : 'Category: '}}</div>
          @foreach($product->categories as $cat)
            <a href="/{{ $cat->slug }}" class="text-primary-lighter font-light mr-2"> {{ $cat->name }}@if(!$loop->last), @endif</a>
          @endforeach
        </div>
        @if(count($product->tags))
        <div class="mt-2 text-sm font-light flex items-center pt-2 border-t border-gray-200">
          <div class="mr-1 text-gray-700">Tags: </div>
          @foreach($product->tags as $tag)
            <a href="/tag/{{ $tag->slug }}" class="text-primary-lighter hover:text-primary font-light mr-2"> {{ $tag->name }}@if(!$loop->last)<span class="mr-1">, </span> @endif</a>
          @endforeach
        </div>
        @endif
        <div class="mt-2 text-sm font-light flex items-center pt-2 pb-2 border-t border-b border-gray-200">
          <div class="mr-1 text-gray-700">SKU: </div>
          <div id="single-product-sku" class="text-gray-500 font-light">{{ $product->sku }}</div>
        </div>
        @if(auth()->user() != NULL)
          <div id="single-product-variations" key="{{ auth()->user()->id }}" index="{{ $product->id }}" variations="{{ json_encode($product->getfilteredVariationsAttribute()) }}"></div>
        @else
          <a href="/login?back={{ request()->path() }}" class="block mt-8 w-2/5 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 font-medium rounded-md hover:bg-primary-light cursor-pointer shadow-sm">
            Login to Order
          </a>
        @endif
      </div>
    </div>
    <div class="mt-12 flex flex-wrap">
    @if(count($product->documents) && count($product->information))
      <div class="w-full sm:w-1/3">
          <h4 class="font-medium text-white bg-primary-light py-2 px-6">Product Information</h4>
          @foreach($product->information as $info)
                @if($info->name)
                  <div class="flex flex-wrap py-1 {{ $loop->index === 0 ? 'mt-3' : 'border-t'}} border-b border-gray-100 px-3 text-sm">
                    <div class="w-full sm:w-1/2 text-gray-500 capitalize font-medium">
                      {{ $info->name }}
                    </div>
                    <div class="w-full sm:w-1/2 text-right text-gray-500 font-light">
                      {{ $info->value }}
                    </div>
                  </div>
                @endif
              @endforeach
        </div>
        <div class="w-full sm:w-1/3">
          <h4 class="font-medium text-white bg-primary-light py-2 px-6">Standards and Approvals</h4>
        </div>
        <div class="w-full sm:w-1/3">
          <h4 class="font-medium text-white bg-primary-light py-2 px-6">Downloads</h4>
          @foreach($product->documents as $doc)
              <div class="py-1 {{ $loop->index === 0 ? 'mt-3' : 'border-t'}} border-b border-gray-100 px-6 text-sm">
                <div class="w-full text-gray-500 capitalize font-medium">
                  <a href="/{{ $doc->file_path }}" target="_blank" class="flex justify-between text-gray-500 hover:text-primary-lighter">
                    <span class="font-medium">{{ $doc->documentName }}</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                  </a>
                </div>
              </div>
            @endforeach
        </div>
      @endif
      <div class="w-full mt-12">
        @if ($product->product_table)
            @php
                $productTable = json_decode($product->product_table, true);
            @endphp
            <section class="product-table">
                <table class="w-full">
                    <thead class="bg-primary-light text-white">
                    <tr class="text-center bg-primary-light text-white">
                        @foreach($productTable[0] as $th)
                            <th class="py-2 px-6">{{ $th }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach(array_slice($productTable,1) as $key => $tr)
                            <tr class="text-center {{ $key % 2 === 1 ? 'bg-gray-100' : '' }}">
                                @foreach($tr as $td)
                                    <td class="py-1">
                                        <div class="flex justify-center w-full">
                                            {!! $td !!}
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
      </div>
    </div>
    <div class="mt-12">
      <h2 class="text-xl font-medium tracking-wide leading-normal">
        Related Products
      </h2>
      <div class="mt-4">
        @include('web.common.product-articles', ['products' => $product->getRelatedProducts(), 'ratio' => 'aspect-w-1 aspect-h-1', 'sort' => true])
      </div>
    </div>
  </div>
</section>
@endsection
