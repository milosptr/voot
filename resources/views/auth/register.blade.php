@extends('layouts.default')
@section('title', 'Create an Account')

@section('content')
  <div class="min-h-screen flex">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <div class="h-20 w-24 flex items-center justify-center bg-primary">
            <img class="h-12 w-auto" src="/images/voot-logo-w.svg" alt="Voot">
          </div>
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Create an Account
          </h2>
        </div>

        <div class="mt-8">
          @error('email')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Email is invalid</strong>
              </div>
          @enderror
          @error('password')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Password is invalid</strong>
              </div>
          @enderror
          @error('ssn')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Social Security Number is required</strong>
              </div>
          @enderror
          <div class="mt-6">
            <form id="register-me" action="/register-me" method="POST" class="space-y-6">
              @csrf
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                  Email address
                </label>
                <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">
                    Full Name
                  </label>
                  <div class="mt-1">
                    <input id="name" name="name" type="text" autocomplete="name" placeholder="John Doe" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="phone" class="block text-sm font-medium text-gray-700">
                    Phone
                  </label>
                  <div class="mt-1">
                    <input id="phone" name="phone" type="phone" autocomplete="phone" placeholder="+354 xxx xxxx" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>

              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="street" class="block text-sm font-medium text-gray-700">
                    Street Address
                  </label>
                  <div class="mt-1">
                    <input id="street" name="street" type="text" autocomplete="street" placeholder="Street 00" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="city" class="block text-sm font-medium text-gray-700">
                    City
                  </label>
                  <div class="mt-1">
                    <input id="city" name="city" type="text" autocomplete="city" placeholder="City" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>

               <div class="flex justify-between items-center">
                  <div class="w-full pr-3">
                    <label for="zip" class="block text-sm font-medium text-gray-700">
                      ZIP
                    </label>
                    <div class="mt-1">
                      <input id="zip" name="zip" type="text" autocomplete="zip" placeholder="ZIP" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                  </div>
                  <div class="w-full pl-3">
                    <label for="country" class="block text-sm font-medium text-gray-700">
                      Country
                    </label>
                    <div class="mt-1">
                      <select name="country" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 sm:text-sm">
                        <option value="IS" selected>Iceland</option>
                        <option value="US">United States</option>
                        <option value="UK">United Kingdom</option>
                        <option readonly disabled>--------------</option>
                        @foreach(App\Models\Country::all() as $country)
                          <option value="{{ $country['alpha_2'] }}">{{ $country['name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
               </div>

              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="ssn" class="block text-sm font-medium text-gray-700">
                    SSN
                  </label>
                  <div class="mt-1">
                    <input id="ssn" name="ssn" type="ssn" autocomplete="ssn" placeholder="Social Security Number" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                  </label>
                  <div class="mt-1">
                    <input id="password" name="password" type="password" placeholder="????????????????" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
              <div class="w-full">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
                  Register
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
                Already have an account
              </span>
            </div>
          </div>
          <div class="mt-6">
            <a href="/login" class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-black border-1 border-solid border-primary-light  focus:outline-none">
              Login
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
      <img class="absolute inset-0 h-full w-full object-cover" src="/images/login-screen.jpeg" alt="">
    </div>
  </div>
@endsection
