@extends('layouts.default')

@section('title')
    {{ __('header.contact') }}
@endsection

@section('content')
    @foreach (App\Models\Location::all() as $location)
        @php
            $fullAddress = $location['address'] . ',' . $location['zip'] . ',' . $location['city'] . ',' . $location['country'];
            $urlAddress = http_build_query(['url' => $fullAddress]);
            $urlAddress = str_replace('url=', '', $urlAddress);
        @endphp
        <section class="container">
            <div class="mb-16 mt-16 sm:mt-32 flex flex-col sm:flex-row lg:justify-between">
                <article class="w-full lg:w-1/4 bg-white relative pt-4 sm:border-r">
                    <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">{{ $location['name'] }}</h5>
                    <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
                    <div class="con-fl justify-between">
                        <div class="table-con">
                            <div class="contact-info-ispod-mape">
                                <p class="font-bold text-base text-gray-800 mt-3">{{ __('default.address') }}</p>
                                <p class="text-base text-gray-800">{{ $location['address'] }}, {{ $location['zip'] }},
                                    {{ $location['city'] }}, {{ $location['country'] }}</p>
                            </div>
                            <div>
                                <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.phone') }}</p>
                                <p class="text-base text-gray-800">{{ $location['phone'] }}</p>
                            </div>
                            <div>
                                <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.email') }}</p>
                                <p class="text-base text-gray-800">{{ $location['email'] }}</p>
                            </div>
                            <div>
                                @if (
                                    $location['monday'] ||
                                        $location['tuesday'] ||
                                        $location['wednesday'] ||
                                        $location['thursday'] ||
                                        $location['friday'] ||
                                        $location['saturday'] ||
                                        $location['sunday']
                                )
                                    <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.opening_hours') }}</p>
                                @endif
                                @if ($location['monday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Mánudaga:</span>
                                        {{ $location['monday'] }}</p>
                                @endif
                                @if ($location['tuesday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Þriðjudaga:</span>
                                        {{ $location['tuesday'] }}</p>
                                @endif
                                @if ($location['wednesday'])
                                    <p class="text-base text-gray-800 font-medium"><span
                                            class="font-normal text-gray-500">Miðvikudaga:</span>
                                        {{ $location['wednesday'] }}</p>
                                @endif
                                @if ($location['thursday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Fimmtudaga:</span>
                                        {{ $location['thursday'] }}</p>
                                @endif
                                @if ($location['friday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Föstudaga:</span>
                                        {{ $location['friday'] }}</p>
                                @endif
                                @if ($location['saturday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Laugardaga:</span>
                                        {{ $location['saturday'] }}</p>
                                @endif
                                @if ($location['sunday'])
                                    <p class="text-base text-gray-900 font-medium"><span
                                            class="font-normal text-gray-500">Sunnudaga:</span>
                                        {{ $location['sunday'] }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mt-5 flex"><a href="https://www.facebook.com/vootehf" class="pr-12"><img
                                    src="/images/face-star.svg" alt="facebook"></a> <a
                                href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.linkedin.com%2Fcompany%2Fvoot-ehf%3Ffbclid%3DIwAR0lDyDOSUoq7DZcs82ue8RCP6coEVpztKYmfilC8lTkWxTN_MLV3LP4zBE&h=AT0cLo8tShyXY_UO3hGhwcyRA-b2Ek7s2LYb4xKizihrDZOqiQr0kiyh2vnGQE50CPO9U_MiiaICvJvb4k098r_P_GMspPeSYXF9sc3EBIJY-y2TMS3N8NXISkeSs_yjWPkxxCmz"
                                class="pr-12 ml-6"><img src="/images/in-star.svg" alt="linkedin"></a></div>
                    </div>
                </article>
                <article class="w-full lg:w-3/4 lg:pl-20 bg-white mt-10 sm:mt-0 rounded-md overflow-hidden"><iframe
                        width="100%" height="600" id="gmap_canvas" class="rounded-md overflow-hidden"
                        src="https://maps.google.com/maps?q={{ $urlAddress }}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></article>
            </div>
        </section>
    @endforeach
@endsection
