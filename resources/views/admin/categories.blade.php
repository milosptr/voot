@extends('layouts.master-admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('button')
  <a href="/backend/categories/new" class="text-white bg-primary-lighter group flex items-center ml-auto px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Add New</a>
@endsection

@section('content')
  <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
      <tr>
        <th scope="col" class="text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
          -
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Image
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Name / Slug
        </th>
        <th scope="col" class="py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
          Status
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Products
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Actions
        </th>
      </tr>
    </thead>
    <tbody id="products-tbody-list" class="bg-white divide-y divide-gray-200">
    @foreach($categories as $category)
      @component('components.category.item', ['category' => $category, 'ischild' => 0, 'index' => $loop->iteration])@endcomponent
      @foreach($category->children as $children)
        @component('components.category.item', ['category' => $children, 'ischild' => 1, $category, 'index' => $loop->iteration ])@endcomponent
        @foreach($children->children as $secondchild)
          @component('components.category.item', ['category' => $secondchild, 'ischild' => 2, $children, 'index' => $loop->iteration])@endcomponent
        @endforeach
      @endforeach
    @endforeach
    </tbody>
  </table>
  @include('components.category.delete')
@endsection
