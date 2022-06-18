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
              <a href="/backend/settings/product-icons" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M120,208H40a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8H93.3a8.1,8.1,0,0,1,4.8,1.6l27.8,20.8a8.1,8.1,0,0,0,4.8,1.6H216a8,8,0,0,1,8,8v32" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><polygon points="188 198.5 217.7 216 209.6 183.4 236 161.6 201.3 158.9 188 128 174.7 158.9 140 161.6 166.4 183.4 158.3 216 188 198.5" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="14"></polygon></svg>
                  <span class="truncate"> Product Icons </span>
                </a>
                <a href="/backend/settings/product-translation" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><polyline points="232 216 176 104 120 216" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polyline><line x1="136" y1="184" x2="216" y2="184" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><line x1="88" y1="32" x2="88" y2="56" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><line x1="24" y1="56" x2="152" y2="56" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M120,56a96,96,0,0,1-96,96" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M61.5,88A95.9,95.9,0,0,0,152,152" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Product Translation </span>
                </a>
                <a href="/backend/settings/staff" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="88" cy="108" r="52" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><path d="M155.4,57.9A54.5,54.5,0,0,1,169.5,56a52,52,0,0,1,0,104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M16,197.4a88,88,0,0,1,144,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M169.5,160a87.9,87.9,0,0,1,72,37.4" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Staff Members </span>
                </a>
                </a>
                <a href="/backend/settings/locations" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="104" r="32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><path d="M208,104c0,72-80,128-80,128S48,176,48,104a80,80,0,0,1,160,0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Locations </span>
                </a>
                <a href="/backend/settings/pages" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M200,176V64a23.9,23.9,0,0,0-24-24H40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><line x1="104" y1="104" x2="168" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><line x1="104" y1="136" x2="168" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M22.1,80A24,24,0,1,1,64,64V192a24,24,0,1,0,41.9-16h112A24,24,0,0,1,200,216H88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Terms Pages </span>
                </a>
                <a href="/backend/settings/newsletter" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><line x1="96" y1="112" x2="176" y2="112" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><line x1="96" y1="144" x2="176" y2="144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M32,200a16,16,0,0,0,16-16V64a8,8,0,0,1,8-8H216a8,8,0,0,1,8,8V184a16,16,0,0,1-16,16Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M32,200a16,16,0,0,1-16-16h0V88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Newsletter Offer </span>
                </a>
                <a href="/backend/settings/config" class="border-transparent text-gray-900 hover:text-gray-900 group border-l-4 px-3 py-2 flex items-center text-sm font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="128" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><path d="M183.7,65.1q3.8,3.5,7.2,7.2l27.3,3.9a103.2,103.2,0,0,1,10.2,24.6l-16.6,22.1s.3,6.8,0,10.2l16.6,22.1a102.2,102.2,0,0,1-10.2,24.6l-27.3,3.9s-4.7,4.9-7.2,7.2l-3.9,27.3a103.2,103.2,0,0,1-24.6,10.2l-22.1-16.6a57.9,57.9,0,0,1-10.2,0l-22.1,16.6a102.2,102.2,0,0,1-24.6-10.2l-3.9-27.3q-3.7-3.5-7.2-7.2l-27.3-3.9a103.2,103.2,0,0,1-10.2-24.6l16.6-22.1s-.3-6.8,0-10.2L27.6,100.8A102.2,102.2,0,0,1,37.8,76.2l27.3-3.9q3.5-3.7,7.2-7.2l3.9-27.3a103.2,103.2,0,0,1,24.6-10.2l22.1,16.6a57.9,57.9,0,0,1,10.2,0l22.1-16.6a102.2,102.2,0,0,1,24.6,10.2Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                  <span class="truncate"> Config </span>
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
