@extends('layouts.default')
@section('title', 'Create an Account')

@section('content')
  <div class="min-h-screen flex">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-lg lg:w-full">
        <div>
          <a href="/" class="h-20 w-24 flex items-center justify-center bg-primary">
            <img class="h-12 w-auto" src="/images/voot-logo-w.svg" alt="Voot">
          </a>
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Núverandi viðskiptavinur
          </h2>
          <p class="mt-2 font-medium">Vinsamlegast athugaðu að engin verð eru aðgengileg á pöntunarsíðunni.</p>
        </div>

        <div class="mt-8">
          <div class="mt-6">
            <form id="account-request" action="/api/account-request" method="POST" class="space-y-6">
              @csrf
              <div id="account-exists-alert" class="hidden text-sm py-2 px-3 rounded-md bg-yellow-100 border border-yellow-400">
                Reikningurinn með þessu kennitala er þegar til í kerfinu okkar. Þú getur fengið nýtt lykilorð fyrir reikninginn þinn með því <a href="/forgot-password">að smella hér</a>.
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="company" class="block text-sm font-medium text-gray-700">
                    Nafn fyrirtækis
                  </label>
                  <div class="mt-1">
                    <input id="company" name="company" type="text" autocomplete="company" placeholder="Nafn fyrirtækis" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="company_ssn" class="block text-sm font-medium text-gray-700">
                    Kennitala fyrirtækis
                  </label>
                  <div class="mt-1">
                    <input id="company_ssn" name="company_ssn" type="number" autocomplete="company_ssn" placeholder="Fyrirtæki kennitala" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="ssn" class="block text-sm font-medium text-gray-700">
                    Kennitala þin
                  </label>
                  <div class="mt-1">
                    <input id="ssn" name="ssn" type="number" autocomplete="ssn" placeholder="Kennitala" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">
                    Netfang notanda
                  </label>
                  <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">
                    Nafn skráningarsaðila
                  </label>
                  <div class="mt-1">
                    <input id="name" name="name" type="text" autocomplete="name" placeholder="John Doe" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="phone" class="block text-sm font-medium text-gray-700">
                    Sími
                  </label>
                  <div class="mt-1">
                    <input id="phone" name="phone" type="phone" autocomplete="phone" placeholder="+354 xxx xxxx" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>

              <div class="w-full">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
                  Fáðu lykilorð
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
                Er nú þegar með reikning
              </span>
            </div>
          </div>
          <div class="mt-6">
            <a href="/login" class="w-full flex justify-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-black border-1 border-solid border-primary-light  focus:outline-none">
              Skrá inn
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
