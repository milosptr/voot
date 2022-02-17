@extends('layouts.master-admin')

@section('title', 'Backend Voot - Products')
@section('page-title', 'Products')
@section('button')
  <div class="relative ml-auto w-1/4">
    <input type="text" id="products-category-search" value="{{ isset($_GET['s']) ? $_GET['s'] : '' }}" name="search" placeholder="Type to search..."
    class="w-full group px-3 pl-10 py-2 text-sm font-normal rounded-md border-gray-500 bg-transparent" />
    <div class="text-gray-500 absolute left-0 top-0 mt-2 ml-2">
      @include('components.icons.search')
    </div>
  </div>
  <a href="/backend/products/new" class="text-white border border-primary-lighter bg-primary-lighter group flex items-center ml-5 px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Add New</a>
@endsection

@section('content')
  <section>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          @include('components.product.filters', ['categories' => $categories])
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Image
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    SKU
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Categories
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody id="products-tbody-list" class="bg-white divide-y divide-gray-200">
                @include('components.product.list', ['products' => $products])
              </tbody>
            </table>
          </div>
          @include('common.pagination', ['pagination' => $pagination])
        </div>
      </div>
    </div>
  </section>
@endsection
