@extends('layouts.master-admin')
@section('bodyclass', 'add-single-product')
@section('backbutton')
  <a href="/backend/products" class="text-pprimary-light group flex items-center px-4 py-2 text-sm font-normal rounded-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
  </a>
@endsection
@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="mt-5 md:mt-0 md:col-span-2">
  <div id="editSingleProduct" data-key="{{ $product->id }}"></div>
  <form id="editProduct" action="/api/products/edit/{{ $product->id }}" method="POST" class="flex">
    @csrf
    <div class="w-2/3 pr-3">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="name" id="title" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $product->name }}" required>
          </div>
          <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea id="product-description" name="description" hidden>{!! $product->description !!}</textarea>
            <input id="wysiwyg-editor" name="description-editor" class="ckeditor" value="">
          </div>
          <div class="mt-6">
            <label for="latin" class="block text-sm font-medium text-gray-700">Latin (species)</label>
            <input type="text" name="species" id="latin" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $product->species }}">
          </div>
        </div>
      </div>
      <!-- <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
        <div class="px-4 py-5 sm:p-6">
          <div class="text-lg text-black font-medium">Pricing</div>
          <div class="flex mt-6">
            <div class="w-1/2 pr-5">
              <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
              <div class="relative input-price-wrapper">
                <input type="text" name="price" id="price" class="mt-1 block w-full pl-10 shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00" required>
              </div>
            </div>
            <div class="w-1/2 pl-5">
              <label for="sale_price" class="block text-sm font-medium text-gray-700">Sale price</label>
              <div class="relative input-price-wrapper">
                <input type="text" name="sale_price" id="sale_price" class="mt-1 block w-full pl-10 shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="0.00">
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
        <div class="px-4 py-5 sm:p-6">
          <div class="text-lg text-black font-medium">Inventory</div>
          <div class="flex mt-6">
            <div class="w-1/2 pr-5">
              <label for="sku" class="block text-sm font-medium text-gray-700">SKU (Stock Keeping Unit)</label>
              <input type="text" name="sku" id="sku" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $product->sku }}" required>
            </div>
            <div class="w-1/2 pl-5">
              <label for="barcode" class="block text-sm font-medium text-gray-700">Barcode (ISBN, UPC, GTIN, etc.)</label>
              <input type="text" id="barcode" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
          </div>
        </div>
      </div>

      <div id="product-documents" data-key="{{ $product->id }}"></div>
      <div id="single-product-info" data-key="{{ $product->id }}"></div>
      <div id="variations-app" data-productid="{{ $product->id }}"></div>
      <div id="single-product-table" data-product-table="{{ $product->product_table }}"></div>
      <input type="text" hidden name="all_variations" id="all_variations" />
      <input type="text" hidden name="product_table" id="product_table" value="{{ $product->product_table }}" />
    </div>
    <div class="w-1/3 pl-3 flex-1">
      <div class="">
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="text-lg font-medium text-black">Product status</div>
            <div class="mt-5">
              <select id="available" name="available" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="on" {{ $product->available ? 'selected' : ''}}>Available</option>
                <option value="off" {{ !$product->available ? 'selected' : '' }}>Not Available</option>
              </select>
              <div class="text-gray-500 text-sm mt-2 pl-1">
                By selecting "Not Available", product will be hidden on the webpage
              </div>
              <div class="mt-6 flex justify-between">
                <button type="submit" class="w-2/5 text-center text-white border border-primary-lighter bg-primary-lighter px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light cursor-pointer">
                  Update
                </button>
                <a href="/product/{{ $product->slug }}" target="_blank" class="w-2/5 text-center text-gray-600 border border-gray-200  px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 hover:text-white cursor-pointer">
                  Preview
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg mt-6">
          <div class="px-4 py-5 sm:p-6">
            <div class="text-lg font-medium text-black">Organization</div>
            <div class="mt-6">
              <div>
                @include('components.category.categories-dropdown', [
                  'id' => 'category',
                  'label' => 'Choose categories',
                  'showAll' => true,
                  'disableFirst' => true,
                  'categories' => $categories,
                  'selected_category' => ''
                ])
                <div class="selected-categories mt-3 pl-1 text-sm text-gray-500">
                  <input id="categories" name="categories" hidden value="{{ $product->categories->pluck('id')->join(',') }}" />

                  @foreach($product->categories as $cat)
                    <div class="flex justify-between items-center selected-category-item py-1 border-b border-gray-100">
                      <div class="pl-2">{{ $cat->name }}</div>
                      <div data-category="{{ $cat->id }}" class="remove-from-categories pr-2 tracking-widest text-3xl font-thin leading-none text-gray-400 cursor-pointer hover:text-rose-500">??</div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="mt-6">
              <div class="text-sm font-medium text-gray-700">Add tags</div>
              <div class="mt-2">
                <div id="product-tags" data-productid="{{ $product->id }}"></div>
              </div>
            </div>
          </div>
        </div>
        <div id="product-icons" data-key="{{ $product->id }}"></div>
        <div id="media-upload" data-key="{{ $product->id }}"></div>
      </div>
    </div>
  </form>
</div>

<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endsection
