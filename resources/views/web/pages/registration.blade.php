@extends('layouts.default')
@section('title', 'Login')

@section('content')
  <section class="py-20">
    <div class="container">
      <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="py-16 px-6 bg-white hover:shadow-xl hover:scale-105 ease-linear duration-300">
          <img src="/images/login-icon.svg" alt="login" width="32" />
          <h2 class="h-16 mt-2 text-3xl font-extrabold text-gray-900">Innskráning</h2>
          <p class="mt-2 h-48">Skráðu þig inná pöntunarsíðuna.</p>
          <a href="/login" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
            Skrá inn
          </a>
        </div>
        <div class="py-16 px-6 bg-gray-100 hover:shadow-xl hover:scale-105 ease-linear duration-300">
          <img src="/images/user-checked-icon.svg" alt="login" width="34" />
          <h2 class="h-16 mt-2 text-3xl font-extrabold text-gray-900 leading-none">Núverandi viðskiptavinur</h2>
          <p class="mt-2 h-48">Ef að þú ert nú þegar í reikningsviðskiptum við Voot vinsamlegast fylltu út formið hér að neðan og við sendum þér tölvupóst með lykilorði til innskráningar á pöntunarsíðuna.</p>
          <a href="/get-account" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
            Fáðu lykilorð
          </a>
        </div>
        <div class="py-16 px-6 bg-gray-200 hover:shadow-xl hover:scale-105 ease-linear duration-300">
          <img src="/images/handshake-icon.svg" alt="login" width="60" />
          <h2 class="h-16 mt-2 text-3xl font-extrabold text-gray-900 leading-none">Komdu í viðskipti við okkur</h2>
          <p class="mt-2 h-48">
            Hefur þú áhuga á að koma í viðskipti hjá okkur í Voot? Einstaklingar, fyrirtæki og stofnanir geta sótt um reikningsviðskipti hjá okkur.
          </p>
          <a href="/register" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-light hover:bg-primary focus:outline-none duration-300 transition-all ease-in-out">
            Sækja um Reikningsviðskipti
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection
