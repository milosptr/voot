@extends('layouts.default')

@section('title', __('default.checkout_title'))

@section('content')
  <section class="bg-gray-50">
    <div class="container mx-auto pt-20 pb-10">
      <h2 class="text-2xl font-medium tracking-wide w-1/2 leading-normal">{{ __('default.checkout_title') }}</h2>
    </div>
  </section>

  <section id="checkout-section" class="pb-24 bg-gray-50">
    <div class="container mx-auto">
      <form class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16" action="/api/v2/request-order/{{ auth()->user()->id }}" method="POST">
        <div class="mt-6 order-2 sm:order-1">
          <div class="">
            <div class="text-lg font-bold text-gray-900">Upplýsingar um viðskiptavin</div>

            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
              <div>
                <label for="selectedCustomer" class="block text-sm font-medium text-gray-700">Nafn / Fyrirtæki</label>
                <div class="mt-1">
                  <select id="selectedCustomer" name="customerKey" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @foreach($companies as $company)
                      <option value="{{ $company->key }}" {{ $company->id === auth()->user()->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Kennitala</label>
                <div class="mt-1">
                  <div type="text" class="block w-full rounded-md bg-white cursor-not-allowed border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    {{ auth()->user()->ssn ?? '/'}}
                  </div>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Tölvupóstur</label>
                <div class="mt-1">
                  <div type="text" class="block w-full rounded-md bg-white cursor-not-allowed border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  {{auth()->user()->email ?? '/'}}
                  </div>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Sími</label>
                <div class="mt-1">
                  <div type="text" class="block w-full rounded-md bg-white cursor-not-allowed border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    {{auth()->user()->phone ?? '/'}}
                  </div>
                </div>
              </div>
              <div class="sm:col-span-2">
                  <label class="block text-sm font-medium text-gray-700">Heimilisfang</label>
                  <div class="mt-1">
                    <div type="text" class="block w-full rounded-md bg-white cursor-not-allowed border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                      {{auth()->user()->street ?? '/'}}
                    </div>
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700">Borg</label>
                      <div class="mt-1">
                        <div type="text" class="bg-white cursor-not-allowed block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          {{auth()->user()->city ?? '/'}}
                        </div>
                      </div>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700">Póstnúmer</label>
                      <div class="mt-1">
                        <div type="text" class="bg-white cursor-not-allowed block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        {{ auth()->user()->zip ?? '/' }}
                        </div>
                      </div>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700">Land</label>
                      <div class="mt-1">
                        <div type="text" class="bg-white cursor-not-allowed block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                          {{auth()->user()->country ?? '/'}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="mt-10 border-t border-gray-200 pt-10">
            <div class="text-lg font-bold text-gray-900">Afhendingarmáti</div>
            <fieldset>
              <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                <label for="delivery-method--delivery" class="relative flex cursor-pointer rounded-lg border-2 border-transparent border-solid bg-white p-4 shadow-sm focus:outline-none delivery-method-active">
                  <input type="radio" id="delivery-method--delivery" checked name="shippingMethod" value="delivery" class="sr-only" aria-labelledby="delivery-method-0-label" aria-describedby="delivery-method-0-description-0 delivery-method-0-description-1">
                  <span class="flex flex-1">
                    <span class="delivery-content flex flex-col">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M176,80h42.6a7.9,7.9,0,0,1,7.4,5l14,35" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><line x1="16" y1="144" x2="176" y2="144" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><circle cx="188" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><circle cx="68" cy="192" r="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><line x1="164" y1="192" x2="92" y2="192" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line><path d="M44,192H24a8,8,0,0,1-8-8V72a8,8,0,0,1,8-8H176V171.2" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M176,120h64v64a8,8,0,0,1-8,8H212" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                      <span id="delivery-method-0-label" class="block text-base font-medium text-gray-900">Senda</span>
                    </span>
                  </span>
                  <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                  </svg>
                  <span class="pointer-events-none absolute -inset-px rounded-lg border-2" aria-hidden="true"></span>
                </label>
                <label for="delivery-method--pickup" class="relative flex cursor-pointer rounded-lg border-2 border-transparent border-solid bg-white p-4 shadow-sm focus:outline-none">
                  <input type="radio" id="delivery-method--pickup" name="shippingMethod" value="pickup" class="sr-only" aria-labelledby="delivery-method-1-label" aria-describedby="delivery-method-1-description-0 delivery-method-1-description-1">
                  <span class="flex flex-1">
                    <span class="delivery-content flex flex-col">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-700" fill="currentColor" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M48,139.6V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M54,40H202a8.1,8.1,0,0,1,7.7,5.8L224,96H32L46.3,45.8A8.1,8.1,0,0,1,54,40Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path><path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg>
                      <span id="delivery-method-1-label" class="block text-base font-medium text-gray-900">Sækja</span>
                    </span>
                  </span>
                  <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                  </svg>
                  <span class="pointer-events-none absolute -inset-px rounded-lg border-2" aria-hidden="true"></span>
                </label>
              </div>
            </fieldset>
          </div>
          <div class="mt-10 border-t border-gray-200 pt-10">
            <div class="text-lg font-bold text-gray-900 mb-5">Upplýsingar um pöntun</div>
            <div id="method--delivery" class="mt-4 grid grid-cols-1 gap-y-6 sm:gap-x-4">
              <div>
                <label for="deliveryMethods" class="block text-sm font-medium text-gray-700">Nafn / Fyrirtæki</label>
                <div class="mt-1">
                  <select id="deliveryMethods" name="shippingMethodCode" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @php
                      $defaultDeliveryMethod = auth()->user()->defaultDeliveryOption();
                    @endphp
                    @foreach(App\Traits\DeliveryMethodsTrait::get() as $company)
                      <option value="{{ $company['id'] }}" {{ $defaultDeliveryMethod === $company['id'] ? 'selected="true"' : '' }}>{{ $company['name'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Afhendingarstaður</label>
                <div class="mt-1">
                  <div type="text" class="bg-white cursor-not-allowed block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    {{auth()->user()->street ?? ''}}, {{auth()->user()->city ?? ''}} {{auth()->user()->zip}}, {{auth()->user()->country ?? ''}}
                  </div>
                </div>
              </div>
              <div>
                <label for="different_address" class="block text-sm font-medium text-gray-700">Annar afgreiðslustaður (valfrjálst)</label>
                <div class="mt-1">
                  <input type="text" id="different_address" name="shippingAddress" placeholder="Afhendingarstaður..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              </div>
            </div>
            <div id="method--pickup" class="hidden">
              <p class="text-gray-500 font-medium">Sækja inn:</p>
              <div class="flex flex-col gap-2 mt-3">
                @foreach(App\Models\Location::all() as $location)
                <div class="text-gray-500 flex gap-2 items-center cursor-pointer">
                  <input type="radio" name="pickupLocation" {{ $location->id === 1 ? 'checked="checked"' : ''}} value="{{$location->id}}" id="pickup-{{$location->id}}" class="focus:ring-0 h-4 w-4 text-primary-lighter border-gray-300">
                  <label for="pickup-{{$location->id}}">{{ $location->fullAddress() }}</label>
                </div>
                @endforeach
              </div>
            </div>
            <div class="my-6">
              <label for="different_date" class="block text-sm font-medium text-gray-700">Dagsetning sendingar (valfrjálst)</label>
              <div class="mt-1">
                <input type="date" id="different_date" name="shippingDate" placeholder="Afhendingarstaður..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
              </div>
            </div>
          </div>
          <div class="mt-10 border-t border-gray-200 pt-10">
            <div class="text-lg font-bold text-gray-900 mb-5">Skilaboð</div>
            <textarea class="w-full border border-gray-300 outline-none rounded-md" id="note" name="note" placeholder="Skrifa hér..."></textarea>
          </div>
          <div class="mt-10">
            <button type="submit" class="w-full flex justify-center items-center small-caps uppercase px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">Panta</button>
          </div>
        </div>
        <div class="order-1 sm:order-2">
          <div class="sticky top-0 rounded-md bg-white border border-gray-300 p-6">
            <div class="flex justify-between items-center">
              <div class="text-lg font-bold text-gray-900">Innkaupakarfa</div>
              <a href="/cart">Breyta körfu</a>
            </div>
            <div class="grid grid-cols-1 divide-y-1 mt-6">
              @foreach(auth()->user()->getCartItems() as $product)
                <div class="py-2 flex items-center gap-4">
                  <img src="/{{$product['featured_image']}}" onerror="this.src='/images/placeholder.png';this.onerror='';" class="aspect-1 w-10">
                  <div>
                    <a href="{{ $product['url'] }}" target="_blank">{{ $product['name'] }}<span class="font-medium"> x {{ $product['qty'] }}</span></a>
                    <div class="font-medium text-sm">{{ $product['sku'] }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <script>
    const deliveryMethods = document.querySelectorAll('input[type=radio][name=shippingMethod]')
    const changeDelivery = (event) => {
      const labels = document.querySelectorAll('label[for^=delivery-method--]')
      const label = document.querySelector(`label[for=delivery-method--${event.target.value}]`)
      const methods = document.querySelectorAll('div[id^=method--]')
      const method = document.getElementById(`method--${event.target.value}`)
      labels.forEach((l) => l.classList.remove('delivery-method-active'))
      methods.forEach((l) => l.classList.add('hidden'))
      if(label)
        label.classList.add('delivery-method-active')
      if(method)
        method.classList.remove('hidden')
    }
    Array.prototype.forEach.call(deliveryMethods, function(method) {
      method.addEventListener('change', changeDelivery);
    });
  </script>
@endsection
