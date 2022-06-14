@extends('layouts.default')

@section('title', __('header.about'))

@section('content')
  <section class="mt-16 sm:mt-0">
    <div class="container mx-auto py-20 ">
      <h2 class="text-2xl font-medium tracking-wide sm:w-1/2 leading-normal">{{ __('default.about_voot_short') }}</h2>
    </div>
  </section>

  <section class="mt-12 sm:mt-0">
    <div class="container mx-auto">
      <div class="overflow-hidden rounded-md sm:w-3/4 ml-auto">
        <img src="/images/world-map.jpg" width="100%" alt="{{ __('header.about') }}" />
      </div>
    </div>
  </section>

  <section class="py-12 sm:py-20">
    <div class="container mx-auto">
      <div class="sm:w-2/3">
        <p class="mb-10 leading-normal">{{ __('default.about_p1')  }}</p>
        <p class="leading-normal">{{ __('default.about_p2')  }}</p>
      </div>
    </div>
  </section>

  <section>
    <div class="container mx-auto border-t border-gray-200">
      <div class="mb-16 sm:my-32 flex flex-col sm:flex-row lg:justify-between">
        <article class="w-full lg:w-96 sm:pr-12 bg-white relative sm:border-r my-12 sm:my-0">
          <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">Reykjavík</h5>
          <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
          <div class="con-fl justify-between">
            <div class="table-con">
                <div class="contact-info-ispod-mape">
                  <p class="font-bold text-base text-gray-800 mt-3">Heimilisfang</p>
                  <p class="text-base text-gray-800">Skarfagarðar 4, 104, Reykjavík, Ísland</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Simi</p>
                  <p class="text-base text-gray-800">+354 581 2222</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Netfang</p>
                  <p class="text-base text-gray-800">voot@voot.is</p>
                </div>
            </div>
          </div>
        </article>
        <article class="w-full lg:w-96 sm:pl-12 bg-white relative sm:border-r py-12 sm:py-0 border-t sm:border-t-0">
          <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">Akureyri</h5>
          <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
          <div class="con-fl justify-between">
            <div class="table-con">
                <div class="contact-info-ispod-mape">
                  <p class="font-bold text-base text-gray-800 mt-3">Heimilisfang</p>
                  <p class="text-base text-gray-800">Norðurtangi 1, 600, Akureyri, Ísland</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Simi</p>
                  <p class="text-base text-gray-800">+354 841 1322</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Netfang</p>
                  <p class="text-base text-gray-800">fannar@voot.is</p>
                </div>
            </div>
          </div>
        </article>
        <article class="w-full lg:w-96 sm:pl-12 bg-white relative py-12 sm:py-0 border-t sm:border-t-0">
          <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">Ólafsvík</h5>
          <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
          <div class="con-fl justify-between">
            <div class="table-con">
                <div class="contact-info-ispod-mape">
                  <p class="font-bold text-base text-gray-800 mt-3">Heimilisfang</p>
                  <p class="text-base text-gray-800">Ólafsbraut 19, 355, Ólafsvík, Ísland</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Simi</p>
                  <p class="text-base text-gray-800">+354 841 1205</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">Netfang</p>
                  <p class="text-base text-gray-800">bjossi@voot.is</p>
                </div>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section id="staff-members" class="py-20 bg-gray-100">
    <div class="container">
      <div class="pb-4 mb-6">
        <h2 class="text-4xl sm:text-5xl font-medium tracking-wide font-lora">{{ __('default.about_staff_title') }}</h2>
      </div>
       <ul role="list" class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
       @foreach(App\Models\Staff::all() as $staff)
          <li class="col-span-1 bg-white rounded-lg divide-y divide-gray-200">
            <div class="w-full flex items-center justify-between p-6 space-x-6">
              <div class="flex-1 truncate">
                <div class="flex items-center space-x-3">
                  <h3 class="text-gray-900 text-sm font-medium truncate"> {{ $staff['name'] }} </h3>
                </div>
                <p class="mt-1 text-gray-500 text-sm truncate"> {{ $staff['role'] }} </p>
              </div>
            </div>
            <div>
              <div class="-mt-px flex divide-x divide-gray-200">
                <div class="w-0 flex-1 flex">
                  <a href="mailto:{{ $staff['email'] }}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-primary-lighter cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    <span class="ml-3">Email</span>
                  </a>
                </div>
                <div class="-ml-px w-0 flex-1 flex">
                  <a href="tel:+354{{ $staff['phone'] }}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-primary-lighter cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    <span class="ml-3">Call</span>
                  </a>
                </div>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </section>

   <section class="py-20">
    <div class="container mx-auto relative">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
        <div class="w-full sm:w-2/5">
          <h2 class="text-4xl sm:text-5xl font-medium tracking-wide font-lora">{{ __('default.newsletter_title') }}</h2>
          <p class="mt-3 font-light text-gray-700">
            {{ __('default.newsletter_desc') }}
          </p>
        </div>
        <div class="w-full sm:w-2/5">
          <form action="" method="POST">
            <div class="relative flex items-center">
              <input type="email" name="email" placeholder="Enter your email" class="shadow-sm focus:ring-primary-lighter focus:border-primary-lighter block w-full pr-24 py-3 border-gray-200 rounded-md">
              <div class="absolute inset-y-0 right-0 flex py-2 pr-2">
                <kbd class="inline-flex items-center border border-primary-lighter bg-primary-lighter text-white rounded px-6 cursor-pointer font-sans font-medium">
                  Join
                </kbd>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
