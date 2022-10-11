<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/favicon.png" sizes="any">
        <link rel="shortcut icon" href="/favicon.png" sizes="any">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <title>Voot | @yield('title')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
        @vite('resources/js/backend.js')
    </head>
    <body class="admin-dashboard @yield('bodyclass')">

      <div>
        <div id="admin-navigation" class="fixed inset-0 flex z-40 md:hidden" role="dialog" aria-modal="true">
          <div class="fixed inset-0 bg-primary-light bg-opacity-75" aria-hidden="true"></div>
          <div class="relative flex-1 flex flex-col max-w-xs w-full bg-primary">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
              <button id="close-admin-navigation" type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                <span class="sr-only">Close sidebar</span>
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>

            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
              <div class="flex-shrink-0 flex items-center justify-between px-4">
                <a href="/" class="flex-shrink-0 flex items-center justify-center">
                  <img class="h-8 w-auto" src="/images/voot-logo-w.svg" alt="Voot Logo">
                </a>
              </div>
              <nav class="mt-5 px-2 space-y-1">
                 @if(auth()->user()->role === 'admin')
                  @include('includes.nav-admin')
                @else
                  @include('includes.nav-customer')
                @endif
              </nav>
            </div>
            <div class="flex-shrink-0 flex bg-primary-light p-4">
              <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0 m-0 group block">
                @csrf
                <button class="flex items-center cursor-pointer">
                  <div class="ml-3">
                    <p class="text-sm font-medium text-white">
                      {{ auth()->user()->name }}
                    </p>
                    <p class="text-left text-xs font-medium text-gray-300 group-hover:text-gray-200">
                      {{ __('backoffice.nav_logout') }}
                    </p>
                  </div>
                </button>
              </form>
            </div>
          </div>

          <div class="flex-shrink-0 w-14">
            <!-- Force sidebar to shrink to fit close icon -->
          </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 relative z-20">
          <div class="flex-1 flex flex-col min-h-0 bg-primary">
            <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
              <div class="flex items-center  flex-shrink-0 px-4">
                <a href="/" class="flex items-center">
                  <img class="h-9 w-auto" src="/images/voot-logo-w.svg" alt="Voot Logo">
                </a>
                @if(auth()->user()->logo)
                  <div class="h-9 w-1 border-l border-gray-500 mx-4"></div>
                  <div class="w-24 h-20 bg-center bg-no-repeat bg-contain" style="background-image: url('/{{ auth()->user()->logo }}')"></div>
                @endif
              </div>
              <nav class="mt-5 flex-1 px-2 space-y-1">
                @if(auth()->user()->role === 'admin')
                  @include('includes.nav-admin')
                @else
                  @include('includes.nav-customer')
                @endif
              </nav>
            </div>
            <div class="flex-shrink-0 flex bg-primary-light p-4">
              <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0 w-full m-0 group block">
                @csrf
                <button class="flex items-center cursor-pointer">
                  <div class="ml-3">
                    <p class="text-sm font-medium text-white">
                      {{ auth()->user()->name }}
                    </p>
                    <p class="text-left text-xs font-medium text-gray-300 group-hover:text-gray-200">
                      {{ __('backoffice.nav_logout') }}
                    </p>
                  </div>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="md:pl-64 flex justify-between">
          <div class="fixed w-full top-0 z-10 md:hidden bg-white border-b border-gray-200">
            <div class="flex justify-between items-center">
              <div class="flex-shrink-0 px-4 py-2 h-full flex items-center bg-primary">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.home') }}">
                  <img class="block lg:hidden h-8 w-auto" src="/images/voot-logo-w.svg" alt="Workflow">
                  <img class="hidden lg:block h-8 w-auto" src="/images/voot-logo-w.svg" alt="Workflow">
                </a>
              </div>
              <button id="open-admin-navigation" type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
              </button>
            </div>
          </div>
          <main class="flex-1 bg-gray-100 min-h-screen">
            @include('common.flash-message')
            <div class="py-6">
              <div class="max-w-7xl mx-auto flex items-center py-4 px-4 sm:px-6 lg:px-8">
                @yield('backbutton')
                <h1 class="text-2xl font-semibold text-gray-900 mr-auo">@yield('page-title')</h1>
                @yield('button')
              </div>
              <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <div class="py-4">
                  @if(auth()->user()->email_verified_at === NULL)
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-10">
                      <div class="flex">
                        <div class="flex-shrink-0">
                          <!-- Heroicon name: solid/exclamation -->
                          <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                          </svg>
                        </div>
                        <div class="ml-3">
                          <p class="text-sm text-yellow-700">
                            Aðgangur þinn bíður ennþá samþykkis starfsfólks Voot. Vinsamlegast <a href="mailto:steini@voot.is" class="font-medium underline text-yellow-700 hover:text-yellow-600">hafðu samband</a> beint til að flýta fyrir ferlinu!
                          </p>
                        </div>
                      </div>
                    </div>
                  @endif
                  @yield('content')
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>

      <script>
        window.current_locale = "{{ app()->getLocale() }}"
      </script>
      <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
      <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    </body>
</html>
