@extends('layouts.master-admin')

@section('title', 'Settings Voot')

@section('content')
@section('page-title', 'Settings')
  <main class="relative">
    <div class="pb-6">
      <div class="bg-white rounded-lg overflow-hidden">
        <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
          <aside class="py-6 lg:col-span-3">
            <header class="relative mb-5">
              <div class="px-3">
                <h1 class="text-lg font-medium">Settings menu</h1>
              </div>
            </header>
            <nav class="space-y-1 settings-page">
              <a href="/backend/settings/product-icons" class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <!-- Heroicon name: outline/cog -->
                  <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M120,208H40a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H93.3a8.1,8.1,0,0,1,4.8,1.6l27.8,20.8a8.1,8.1,0,0,0,4.8,1.6H216a8,8,0,0,1,8,8v32" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path><polygon points="188 198.5 217.7 216 209.6 183.4 236 161.6 201.3 158.9 188 128 174.7 158.9 140 161.6 166.4 183.4 158.3 216 188 198.5" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polygon></svg>
                  <span class="truncate"> Product Icons </span>
                </a>
            </nav>
          </aside>
          <div class="divide-y divide-gray-200 lg:col-span-9 p-6">
            <div id="settings"></div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
