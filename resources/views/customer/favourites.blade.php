@extends('layouts.master-admin')

@section('title', 'Favourites Voot')

@section('content')
  <section>
    <h1 class="text-2xl font-semibold text-gray-900 mr-auo mb-12">{{ __('backoffice.nav_favourites') }}</h1>
      @include('web.common.product-articles', [
        'products' => auth()->user()->favourites,
        'cols' => 5,
        'bg' => 'bg-white',
        'ratio' => 'aspect-w-4 aspect-h-4'
      ])
  </section>
@endsection
