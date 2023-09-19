@extends('layouts.master-admin')

@section('title', 'Settings')

@section('content')
@section('page-title', 'Clients')
@section('button')
    <div class="relative ml-auto">
        <a href="/backend/settings/clients/new"
            class="text-white border border-primary-lighter bg-primary-lighter group flex items-center ml-5 px-6 py-2 text-sm font-normal rounded-md hover:bg-primary-light">Create
            New</a>
    </div>
@endsection
<section id="adminClientsSection"></section>
@endsection
