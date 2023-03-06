@extends('layouts.master-admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('button')
  <a href="/backend/categories/new" class="text-white bg-primary-lighter group flex items-center ml-auto px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Add New</a>
@endsection

@section('content')
  <div id="adminCategories"></div>
  @include('components.category.delete')
@endsection
