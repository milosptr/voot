@extends('layouts.default')

@section('title', __('default.page_not_found_title'))

@section('content')
  <section class="single-page my-32">
    <div class="container mx-auto">
      <h2 class="text-4xl sm:text-5xl font-medium tracking-wide font-lora pb-12">{{ $page['title'] }}</h2>
      {!! $page['content'] !!}
    </div>
  </section>
@endsection
