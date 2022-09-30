@extends('layouts.master-admin')

@section('title', __('backoffice.nav_members') )

@section('content')
  <section>
    <h1 class="text-2xl font-semibold text-gray-900 mr-auo mb-12">{{ __('backoffice.nav_members') }}</h1>
    <div id="members-info" data-key="{{ auth()->user()->id }}"></div>
  </section>
@endsection
