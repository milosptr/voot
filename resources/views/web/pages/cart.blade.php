@extends('layouts.default')

@section('title', __('default.cart_title'))

@section('content')
    <section>
        <div class="container mx-auto py-20">
            <h2 class="text-2xl font-medium tracking-wide w-1/2 leading-normal">{{ __('default.cart_title') }}</h2>
        </div>
    </section>

    <section class="pb-24">
        <div class="container mx-auto">
            <div id="shopping-cart-app"></div>
        </div>
    </section>

    <section>
        <div class="container mx-auto">

        </div>
    </section>
    <input id="cart" type="text" value="{{ json_encode($cart) }}" data-key={{ auth()->user()->id }} hidden />
@endsection
