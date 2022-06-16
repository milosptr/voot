@extends('layouts.master-admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('button')
  <a href="/backend/categories/new" class="text-white bg-primary-lighter group flex items-center ml-auto px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Add New</a>
@endsection

@section('content')
  <div class="min-w-full bg-gray-50">
    <div class="flex justify-between items-center">
      <div class="w-32 text-center px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">
        -
      </div>
      <div class="w-20 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
        Image
      </div>
      <div class="w-1/3 mr-auto py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Name / Slug
      </div>
      <div class="w-24 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
        Status
      </div>
      <div class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Products
      </div>
      <div class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Actions
      </div>
    </div>
  </div>
  <div id="adminCategories"></div>
  @include('components.category.delete')
@endsection
