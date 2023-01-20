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
            Komdu i viðskipti
          </h2>
          <p class="mt-2">Vinsamlegast athugið að það getur tekið allt að 2 virka daga að stofna nýja viðskiptavini í viðskipti hjá Voot.</p>
          <p class="mt-2 font-medium">Vinsamlegast athugaðu að engin verð eru aðgengileg á pöntunarsíðunni.</p>
          <p class="mt-2 font-medium">Við reynum að lágmarka pappirsnotkun og allir reikningar eru sendir rafrænt, því er nauðsynlegt að gefa upp tölvupóst sem reikningar sendast á.</p>
        </div>

        <div class="mt-8">
          @error('email')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Netfangið er ógilt</strong>
              </div>
          @enderror
          @error('password')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Lykilorð er ógilt</strong>
              </div>
          @enderror
          @error('ssn')
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-xs font-semibold" role="alert">
                <strong class="font-semibold text-sm">Kennitala er krafist</strong>
              </div>
          @enderror
          <div class="mt-6">
            <form id="register-me" action="/register-me" method="POST" class="space-y-3">
              @csrf
              <div id="account-exists-alert" class="hidden text-sm py-2 px-3 rounded-md bg-yellow-100 border border-yellow-400">
                Þessi kennitala er nú þegar skráð hjá okkur. Þú getur fengið lykilorð fyrir aðgang með Því <a href="/get-account">að smella hér</a>.
              </div>
              <div class="w-full">
                <label for="ssn" class="block text-sm font-medium text-gray-700">
                  Kennitala fyrirtækis
                </label>
                <div class="mt-1">
                  <input id="ssn" name="ssn" type="ssn" autocomplete="ssn" placeholder="Kennitala" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">
                    Netfang notanda
                  </label>
                  <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="invoice_email" class="block text-sm font-medium text-gray-700">
                    Netfang f. reikninga/bókhald
                  </label>
                  <div class="mt-1">
                    <input id="invoice_email" name="invoice_email" type="email" autocomplete="email" placeholder="user@email.com" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="name" class="block text-sm font-medium text-gray-700">
                    Nafn skráningar aðila
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

              <div class="flex justify-between items-center">
                <div class="w-full pr-3">
                  <label for="street" class="block text-sm font-medium text-gray-700">
                    Heimilisfang
                  </label>
                  <div class="mt-1">
                    <input id="street" name="street" type="text" autocomplete="street" placeholder="Heimilisfang" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
                <div class="w-full pl-3">
                  <label for="city" class="block text-sm font-medium text-gray-700">
                    Borg
                  </label>
                  <div class="mt-1">
                    <input id="city" name="city" type="text" autocomplete="city" placeholder="Borg" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>

               <div class="flex justify-between items-center">
                  <div class="w-full pr-3">
                    <label for="zip" class="block text-sm font-medium text-gray-700">
                      Postnúmer
                    </label>
                    <div class="mt-1">
                      <input id="zip" name="zip" type="text" autocomplete="zip" placeholder="Postnúmer" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                  </div>
                  <div class="w-full pl-3">
                    <label for="country" class="block text-sm font-medium text-gray-700">
                      Land
                    </label>
                    <div class="mt-1">
                      <select name="country" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 sm:text-sm">
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
                <div class="w-full">
                  <label for="password" class="block text-sm font-medium text-gray-700">
                    Lykilorð
                  </label>
                  <div class="mt-1">
                    <input id="password" name="password" type="password" placeholder="········" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  </div>
                </div>
              </div>
              <div class="w-full">
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
                  Nýskráning
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
