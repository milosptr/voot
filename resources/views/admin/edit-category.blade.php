@extends('layouts.master-admin')

@section('backbutton')
  <a href="/backend/categories" class="text-pprimary-light group flex items-center px-4 py-2 text-sm font-normal rounded-md">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
  </a>
@endsection
@section('title', 'Edit Category')
@section('page-title', 'Edit Category')

@section('content')
<div class="mt-10 sm:mt-0 flex">
  <div class="w-1/2 pr-4">
    <div class="mt-5 md:mt-0 md:col-span-2">
      <form id="editCategory" action="/api/product-category/{{ $category->id }}" method="POST" data-category-id="{{ $category->id }}">
        @csrf
        <div class="overflow-hidden sm:rounded-md">
          <div class="py-6">
            <div>
              <label for="fileDrop" class="block text-sm font-medium text-gray-700">
              Category image (automatic upload - no need to save)
              </label>
              <div class="flex justify-between mt-2">
                <input type="file"
                  id="fileDrop"
                  class="filepond"
                  name="file"
                  data-allow-reorder="false"
                  data-max-file-size="3MB"
                  data-max-files="1">
                <div class="category-featured-image" style="background-image: url('/{{ isset($category->image) ? $category->image->file_path : '' }}');"></div>
              </div>
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Category name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
              </div>
              <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mt-6">Category english name</label>
                <input type="text" name="name_en" id="name_en" value="{{ $category->name_en }}" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
              </div>
              <div class="mt-6">
                <label for="slug" class="block text-sm font-medium text-gray-700">Category slug <span class="font-normal">(autofilled)</span></label>
                <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
              </div>
              <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="font-normal">(optional)</span></label>
                <input type="text" name="description" id="description" value="{{ $category->description }}" class="mt-1  block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
              </div>

              <div class="mt-6">
                <label for="parent" class="block text-sm font-medium text-gray-700">Parent</label>
                <select id="parent" name="parent_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none  sm:text-sm" required>
                  <option value='0' {{ !$category->parent_id ? 'selected' : '' }}>No Parent</option>
                  @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>
                      {{ $cat->name }}
                    </option>
                    @foreach($cat->children as $subcategory)
                      <option value="{{ $subcategory->id }}" {{ $subcategory->id == $category->parent_id ? 'selected' : '' }}>
                        {{ '— '.$subcategory->name }}
                      </option>
                      @foreach($subcategory->children as $subsubcategory)
                        <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id == $category->parent_id ? 'selected' : '' }}>
                          {{ '— —'.$subsubcategory->name }}
                        </option>
                      @endforeach
                    @endforeach
                  @endforeach
                </select>
              </div>

              <div class="flex items-center mt-6">
                <input type="checkbox" id="available" name="available" {{ $category->available ? 'checked' : '' }} />
                <label for="available" class="block text-sm font-medium text-gray-700 ml-6">Is this category available?</label>
              </div>

          </div>
          <div class="py-3 mt-10">
            <button type="submit" class="inline-flex justify-center py-2 px-12 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-lighter hover:bg-primary-light focus:outline-none">
              Update Category
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@if(!count($category->subcategory()))
  <div class="w-1/2 pl-4">
    <div id="sortable-category-products" class="bg-white shadow rounded-md p-8 h-full">
      @foreach($category->products()->orderBy('category_order', 'ASC')->get() as $product)
          <div data-key="{{ $product->id }}" class="bg-white flex items-center text-sm border-b border-gray-100 py-2">
          <div class="w-8">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="24" height="24" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="cursor-move"><path d="M11 18c0 1.1-.9 2-2 2s-2-.9-2-2s.9-2 2-2s2 .9 2 2zm-2-8c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2zm6 4c1.1 0 2-.9 2-2s-.9-2-2-2s-2 .9-2 2s.9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2z" fill="#e2e2e2"/></svg>
          </div>
          <div class="w-8">
            {{ $loop->iteration }}.
          </div>
          <div class="w-10 h-10 bg-gray-100 rounded-md mr-4">
            <div class="h-full bg-cover bg-center rounded-md" style="background-image: url('/{{ isset($product->featuredImage) ? $product->featuredImage->file_path : '' }}')"></div>
          </div>
          <div class="w-1/4">
              {{ $product->name }}
          </div>
        </div>
      @endforeach
    </div>
  </div>
  @endif
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
