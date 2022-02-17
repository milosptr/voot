@extends('layouts.default')
@section('title', 'Login')

@section('content')
  <div class="min-h-screen flex">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <a href="/" class="h-20 w-24 flex items-center justify-center bg-primary">
            <img class="h-12 w-auto" src="/images/voot-logo-w.svg" alt="Voot">
          </a>
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Log in to your account
          </h2>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
              @csrf
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                  Email address
                </label>
                <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
              </div>

              <div class="space-y-1">
                <label for="password" class="block text-sm font-medium text-gray-700">
                  Password
                </label>
                <div class="mt-1">
                  <input id="password" name="password" type="password" placeholder="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
              </div>

              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                  <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                    Remember me
                  </label>
                </div>
                @if(isset($_GET['back']))
                  <input name="redirect_to" value="{{ $_GET['back'] }}" hidden />
                @endif
                <div class="text-sm">
                  <a href="#" class="font-medium text-primary-light cursor-pointer">
                    Forgot your password?
                  </a>
                </div>
              </div>

              <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
                  Log in
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">
                Don't have an account
              </span>
            </div>
          </div>
          <div class="mt-6">
            <a href="/register" class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-black border-1 border-solid border-primary-light  focus:outline-none">
              Register
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
      <img class="absolute inset-0 h-full w-full object-cover" src="/images/login-screen.jpg" alt="">
    </div>
  </div>
@endsection
