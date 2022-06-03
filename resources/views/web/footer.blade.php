<footer class="bg-primary py-12">
  <div class="container">
    <div class="w-full flex border-b border-gray-500 pb-6 mb-6">
      <div class="w-full sm:w-1/4">
        <a href="/" class="block">
          <img class="h-12 w-auto" src="/images/voot-logo-w.svg" alt="Voot">
        </a>
      </div>
    </div>
    <div class="flex flex-col sm:flex-row">
      <div class="w-full sm:w-1/3">
        <h6 class="text-white text-3xl font-medium tracking-wide font-lora">Voot ehf.</h6>
        <div class="mt-10">
        @foreach(App\Models\Location::all() as $location)
          @php
            $address = $location['address'] . ', '. $location['zip']  . ', '.  $location['city'] . ', '. $location['country'];
          @endphp
          <div class="flex mt-2">
            <div class="w-4 mr-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="#fff" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="104" r="32" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><path d="M208,104c0,72-80,128-80,128S48,176,48,104a80,80,0,0,1,160,0Z" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
            </div>
            <a href="https://www.google.com/maps?q={{ $address }}" target="_blank" class="text-white tracking-wide font-light hover:text-gray-400">{{ $address }}</a>
          </div>
        @endforeach
        </div>
      </div>
      <div class="hidden sm:flex sm:w-1/3 pl-20">
        <img src="/images/map-footer.svg" width="50%" alt="iceland map" />
      </div>
      <div class="w-full sm:w-1/3 ml-auto mt-6 sm:mt-0">
        <h6 class="text-white text-3xl font-medium tracking-wide font-lora mb-8">Links</h6>
        <div class="flex">
          <div class="w-1/2">
            <a href="" class="block text-white tracking-wide font-light hover:text-gray-400">{{ __('header.about') }}</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">{{ __('header.services') }}</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">{{ __('header.products') }}</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">{{ __('header.contact') }}</a>
          </div>
          <div class="w-1/2">
            <a href="" class="block text-white tracking-wide font-light hover:text-gray-400">FAQ</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">Terms & Conditions</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">Privacy Policy</a>
            <a href="" class="block text-white tracking-wide font-light mt-2 hover:text-gray-400">Cookie Policy</a>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full flex border-t border-gray-500 pt-6 mt-6">
      <h6 class="text-gray-100 font-light text-sm"> Voot ehf. {{ date('Y') }}. © All rights reserved.</h6>
    </div>
  </div>
</footer>
