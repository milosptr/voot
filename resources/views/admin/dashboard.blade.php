@extends('layouts.master-admin')

@section('title', 'Backend Voot')
@section('page-title', 'Dashboard')

@section('content')
  <section>
    <div class="flex gap-5">
      <div class="bg-white rounded-md shadow border border-gray-100 px-6 py-3 flex items-center text-right">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M224,177.3V78.7a8.1,8.1,0,0,0-4.1-7l-88-49.5a7.8,7.8,0,0,0-7.8,0l-88,49.5a8.1,8.1,0,0,0-4.1,7v98.6a8.1,8.1,0,0,0,4.1,7l88,49.5a7.8,7.8,0,0,0,7.8,0l88-49.5A8.1,8.1,0,0,0,224,177.3Z" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polyline points="177 152.5 177 100.5 80 47" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><polyline points="222.9 74.6 128.9 128 33.1 74.6" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline><line x1="128.9" y1="128" x2="128" y2="234.8" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
        <a href="/backend/products" class="block ml-10">
          <h2 class="text-sm font-medium uppercase text-gray-600">Products</h2>
          <div class="font-bold tracking-wider text-gray-600">
            {{ App\Models\Product::where('available', 1)->get()->count() }}
          </div>
        </a>
      </div>
      <div class="bg-white rounded-md shadow border border-gray-100 px-6 py-3 flex items-center text-right">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-600 transform rotate-180" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><rect x="44" y="44" width="168" height="168" rx="8" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></rect><line x1="128" y1="44" x2="128" y2="212" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="128" y1="80" x2="212" y2="80" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="128" y1="112" x2="212" y2="112" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="128" y1="144" x2="212" y2="144" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line><line x1="128" y1="176" x2="212" y2="176" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></line></svg>
        <a href="/backend/categories" class="block ml-10">
          <h2 class="text-sm font-medium uppercase text-gray-600">Categories</h2>
          <div class="font-bold tracking-wider text-gray-600">
            {{ App\Models\Category::where('available', 1)->get()->count() }}
          </div>
        </a>
      </div>
      <div class="bg-white rounded-md shadow border border-gray-100 px-6 py-3 flex items-center text-right">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,139.6V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.6" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M54,40H202a8.1,8.1,0,0,1,7.7,5.8L224,96H32L46.3,45.8A8.1,8.1,0,0,1,54,40Z" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="#214B76" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
        <a href="/backend/orders" class="block ml-10">
          <h2 class="text-sm font-medium uppercase text-gray-600">Orders</h2>
          <div class="font-bold tracking-wider text-gray-600">
            {{ App\Models\Order::all()->count() }}
          </div>
        </a>
      </div>
    </div>
  </section>
@endsection
