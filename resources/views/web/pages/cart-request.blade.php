@extends('layouts.default')

@section('title', __('default.cart_title'))

@section('content')
    <section class="bg-gray-50">
        <div class="container">
            @if (count($cart) === 0)
                <div class="min-h-[50vh]">
                    <div class="py-24">
                        <h1 class="text-2xl font-medium tracking-wide leading-normal mb-12">Verðtilboðskarfa</h1>
                        <div class="font-bold">Verðtilboðskarfa er tóm. Vinsamlegast bættu við nokkrum vörum!</div><a
                            href="/vorur"
                            class="small-caps uppercase block w-2/5 mt-6 text-center text-gray-600 border border-gray-200 px-6 py-2 text-sm font-normal rounded-md hover:bg-gray-200 cursor-pointer">
                            Skoða vörur </a>
                    </div>
                </div>
            @else
                <div class="mx-auto w-full px-4 py-16 sm:px-6 sm:py-24 lg:px-0">
                    <h1 class="text-2xl font-medium tracking-wide leading-normal">Verðtilboðskarfa</h1>
                    <form action="{{ route('askForPrice') }}" method="POST"
                        class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16 mt-6"
                        onsubmit="handleSubmit()">
                        <div class="mt-6 order-2 sm:order-1">
                            <div class="text-lg font-bold text-gray-900">Upplýsingar um viðskiptavin</div>
                            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nafn / Fyrirtæki</label>
                                    <div class="mt-1">
                                        <input type="text" id="name" name="name" required
                                            placeholder="Jón Jónsson"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kennitala</label>
                                    <div class="mt-1">
                                        <input type="text" id="ssn" name="ssn" required
                                            placeholder="1234567890"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tölvupóstur</label>
                                    <div class="mt-1">
                                        <input type="text" id="email" name="email" required
                                            placeholder="jon.jonson@email.com"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sími</label>
                                    <div class="mt-1">
                                        <input type="text" id="phone" name="phone" required
                                            placeholder="7891234 eða +3547891234"
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10 border-t border-gray-200 pt-10">
                                <div class="text-lg font-bold text-gray-900 mb-5">Skilaboð</div>
                                <textarea class="w-full border border-gray-300 outline-none rounded-md" id="note" name="note"
                                    placeholder="Skrifa hér..."></textarea>
                            </div>
                            <div class="mt-10">
                                <button type="submit" id="formSubmitBtn"
                                    class="w-full flex justify-center items-center small-caps uppercase px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 cursor-pointer">Óska
                                    eftir verðtilboði</button>
                            </div>
                        </div>
                        <div class="order-1 sm:order-2">
                            <div class="sticky top-0 rounded-md bg-white border border-gray-300 p-6">
                                <div class="text-lg font-bold text-gray-900">Innkaupakarfa</div>
                                <div class="grid grid-cols-1 divide-y-1 mt-6">
                                    @foreach ($cart as $item)
                                        <div class="py-2 flex items-center gap-4 relative">
                                            <a href="/api/request/remove-from-cart/{{ $item['id'] }}"
                                                class="absolute right-1 top-3">
                                                <img src="/images/trash.svg" alt="remove" class="w-5 h-5">
                                            </a>
                                            <img src="{{ $item->getProductImage() }}" class="aspect-1 w-16">
                                            <div class="flex flex-col">
                                                <a href="{{ $item->getProduct()->productUrl }}"
                                                    class="text-sm text-gray-700">
                                                    <span
                                                        class="text-primary-lighter font-medium">{{ $item->getProduct()->name }}</span>
                                                    <strong>x {{ $item['quantity'] }}</strong></a>
                                                <div class="text-sm text-gray-500">{{ $item['product_sku'] }}</div>
                                                <div class="text-sm text-gray-500">{{ $item->getVariantValue() }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </section>
    <script>
        const handleSubmit = () => {
            document.getElementById('formSubmitBtn').disabled = true;
            document.getElementById('formSubmitBtn').innerHTML = 'Vinsamlegast bíðið...';
        }
    </script>
@endsection
