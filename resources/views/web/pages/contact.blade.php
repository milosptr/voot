@extends('layouts.default')

@section('title') {{ __('header.contact') }} @endsection

@section('content')
<section class="container">
  <div class="mb-16 mt-32 flex flex-col sm:flex-row lg:justify-between">
   <article class="w-full lg:w-1/4 bg-white relative pt-16 sm:border-r">
      <h5 class="font-bold text-5xl text-gray-800 mb-6">Reykjavík</h5>
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
         <div class="mt-5 sm:mt-16 flex"><a href="" class="pr-12"><img src="/images/face-star.svg" alt="facebook"></a> <a href="" class="pr-12 ml-6"><img src="/images/ins-star.svg" alt="instagram"></a> <a href="" class="pr-12 ml-6"><img src="/images/in-star.svg" alt="linkedin"></a></div>
      </div>
   </article>
   <article class="w-full lg:w-3/4 lg:pl-20 bg-white mt-10 sm:mt-0"><iframe width="100%" height="600" id="gmap_canvas" src="https://maps.google.com/maps?q=Skarfagar%C3%B0ar%204,%20104,%20Reykjavi%CC%81k,%20I%CC%81sland&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></article>
  </div>
</section>

<section class="container border-1 border-t sm:border-none">
  <div class="my-16 flex flex-col sm:flex-row lg:justify-between">
    <article class="w-full lg:w-1/4 bg-white relative pt-16 sm:border-r">
      <h5 class="font-bold text-5xl text-gray-800 mb-6">Akureyri</h5>
      <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
      <div class="con-fl justify-between">
        <div class="table-con">
          <div class="contact-info-ispod-mape">
            <p class="font-bold text-base text-gray-800 mt-3">Heimilisfang</p>
            <p class="text-base text-gray-800">Norðurtangi 1, 600 Akureyri, Ísland</p>
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
        <div class="flex mt-5 sm:mt-16"><a href="" class="pr-12"><img src="/images/face-star.svg" alt="facebook"></a> <a href="" class="pr-12 ml-6"><img src="/images/ins-star.svg" alt="instagram"></a> <a href="" class="pr-12 ml-6"><img src="/images/in-star.svg" alt="linkedin"></a></div>
      </div>
    </article>
    <article class="w-full lg:w-3/4 lg:pl-20 bg-white mt-10 sm:mt-0"><iframe width="100%" height="600" id="gmap_canvas" src="https://maps.google.com/maps?q=Nor%C3%B0urtangi%201,%20603%20Akureyri&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></article>
  </div>
</section>
@endsection
