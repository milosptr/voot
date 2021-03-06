@php
  $lang = app()->getLocale() === 'en' ? 'is' : 'en';
@endphp
<nav id="navigation" class="relative z-10 border-b border-gray-200 bg-white">
  <div class="container mx-auto">
    <div class="relative flex items-center justify-between h-16">
      <div class="flex items-center px-2 lg:px-0 h-full">
        <div class="flex-shrink-0 px-4 h-full flex items-center bg-primary">
          <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.home') }}">
            <img class="block lg:hidden h-8 w-auto" src="/images/voot-logo-w.svg" alt="Workflow">
            <img class="hidden lg:block h-8 w-auto" src="/images/voot-logo-w.svg" alt="Workflow">
          </a>
        </div>
        <div id="main-menu" class="lg:block lg:ml-6">
          <div class="flex flex-col sm:flex-row space-x-4 ">
            @php
              $route = \Request::route()->getName();
            @endphp
            <div class="sm:hidden flex justify-between pt-4 pb-8">
              <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.home') }}">
                <img class="block h-10 w-auto" src="/images/voot-logo-w.svg" alt="Workflow">
              </a>
              <div id="close-menu-btn">
                <svg class="w-8 h-8" fill="none" stroke="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
              </div>
            </div>
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.about') }}" class="text-gray-600 hover:text-primary-light px-3 py-2 rounded-md font-light {{ $route === 'about' ? 'font-medium' : '' }}">{{ __('header.about') }}</a>
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.services') }}" class="text-gray-600 hover:text-primary-light px-3 py-2 rounded-md font-light {{ $route === 'services' ? 'font-medium' : '' }}">{{ __('header.services') }}</a>
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.all_products') }}" class="text-gray-600 hover:text-primary-light px-3 py-2 rounded-md font-light {{ $route === 'all_products' ? 'font-medium' : '' }}">{{ __('header.products') }}</a>
            <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.contact') }}" class="text-gray-600 hover:text-primary-light px-3 py-2 rounded-md font-light {{ $route === 'contact' ? 'font-medium' : '' }}">{{ __('header.contact') }}</a>
          </div>
        </div>
      </div>
      <div id="nav-search" class="absolute top-0 right-0 mr-20 mt-3 justify-center lg:ml-6 lg:justify-end hidden">
        <div class="max-w-lg w-full lg:max-w-xs">
          <label for="search" class="sr-only">Search</label>
          <div class="relative z-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <!-- Heroicon name: solid/search -->
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </div>
            <form action="{{  LaravelLocalization::localizeURL('/products/search') }}" method="GET" class="sm:mr-16">
              <input id="search" name="q" class="block w-full pl-10 pr-3 py-2 font-light border border-transparent border-gray-200 rounded-md leading-5 bg-gray-50 text-gray-900 placeholder-gray-500 focus:outline-none" placeholder="{{ __('header.search') }}" type="search">
            </form>
          </div>
        </div>
      </div>
      <div class="flex items-center relative z-10">
        <div id="open-search-btn" class="cursor-pointer">
          <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
          </svg>
        </div>
        <a href="{{ LaravelLocalization::getLocalizedURL($lang) }}" class="ml-4">
          <img src="/images/{{ __('header.language') }}.png" width="24" alt="en" />
        </a>
        <a href="/app/favourites" class="ml-4 text-gray-600 hover:text-primary-lighter relative">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#000000" viewBox="0 0 256 256" @click="addToFavourites"><rect width="256" height="256" fill="none"></rect><path d="M132.4,190.7l50.4,32c6.5,4.1,14.5-2,12.6-9.5l-14.6-57.4a8.7,8.7,0,0,1,2.9-8.8l45.2-37.7c5.9-4.9,2.9-14.8-4.8-15.3l-59-3.8a8.3,8.3,0,0,1-7.3-5.4l-22-55.4a8.3,8.3,0,0,0-15.6,0l-22,55.4a8.3,8.3,0,0,1-7.3,5.4L31.9,94c-7.7.5-10.7,10.4-4.8,15.3L72.3,147a8.7,8.7,0,0,1,2.9,8.8L61.7,209c-2.3,9,7.3,16.3,15,11.4l46.9-29.7A8.2,8.2,0,0,1,132.4,190.7Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
        </a>
        <a href="/cart" class="ml-4 text-gray-600 hover:text-primary-light relative">
          @if(auth()->user())
            @php $inCart = App\Models\Cart::cartNumber(auth()->user()->id); @endphp
            @if($inCart)
              <div class="absolute right-0 top-0 items-center justify-center text-center w-4 h-4 text-xs font-medium -mt-2 -mr-2 bg-red-500 text-white rounded-full">
                {{ $inCart }}
              </div>
            @endif
          @endif
          <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        </a>
        <a href="{{ auth()->user() != NULL ? '/backend' : route('login') }}" class="ml-4 text-gray-600 hover:text-primary-light">
          @if(auth()->user() != NULL)
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="96" r="64" opacity="0.2"></circle><circle cx="128" cy="96" r="64" fill="none" stroke="#000000" stroke-miterlimit="10" stroke-width="20"></circle><path d="M31,216a112,112,0,0,1,194,0" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"></path></svg>
          @else
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256">
              <rect width="256" height="256" fill="none"></rect>
              <circle cx="128" cy="96" r="64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"></circle>
              <path d="M31,216a112,112,0,0,1,194,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="20"></path>
            </svg>
          @endif
        </a>
        <div id="open-menu-btn" class="sm:hidden ml-4 text-gray-600 hover:text-primary-light">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </div>
      </div>
    </div>
  </div>
</nav>
