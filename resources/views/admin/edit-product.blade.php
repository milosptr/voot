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
      {{-- <div id="product-documents" data-key="{{ $product->id }}"></div> --}}
      {{-- <div id="single-product-info" data-key="{{ $product->id }}"></div> --}}
      {{-- <div id="variations-app" data-productid="{{ $product->id }}"></div> --}}
      {{-- <div id="single-product-table" data-product-table="{{ $product->product_table }}"></div> --}}
      <input type="text" hidden name="all_variations" id="all_variations" />
      <input type="text" hidden name="product_table" id="product_table" value="{{ $product->product_table }}" />
    </div>
    <div class="w-1/3 pl-3 flex-1">
      <div class="">
        {{-- <div id="media-upload" data-key="{{ $product->id }}"></div> --}}
      </div>
    </div>
  </form>
</div>

<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
@endsection
