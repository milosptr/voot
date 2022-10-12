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
            Endur stilla lykilorð
          </h2>
        </div>
        <div class="mt-4 mb-4 text-sm text-gray-600">
            Láttu okkur bara vita netfangið þitt og við sendum þér tölvupóst með hlekk til að endurstilla lykilorð sem gerir þér kleift að velja nýjan.
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Netfang
              </label>
              <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              </div>
            </div>

            <div class="mt-6">
              <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
                Senda endurstilla hlekk
              </button>
            </div>
        </form>
      </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
      <img class="absolute inset-0 h-full w-full object-cover" src="/images/login-screen.jpeg" alt="">
    </div>
  </div>
@endsection
