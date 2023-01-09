@extends('layouts.default')

@section('title', __('header.about'))

@section('content')
  <section class="mt-16 sm:mt-0">
    <div class="container mx-auto py-20 ">
      <h2 class="text-2xl font-unset font-medium tracking-wide sm:w-2/3 leading-normal">{{ __('default.about_voot_short') }}</h2>
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
        <p class="leading-normal mt-3">{{ __('default.about_p3')  }}</p>
        <p class="leading-normal mt-3">{{ __('default.about_p4')  }}</p>
        <p class="leading-normal mb-10">{{ __('default.about_p5')  }}</p>
        <p class="leading-normal mt-3">{{ __('default.about_p6')  }}</p>
      </div>
    </div>
    <div class="container mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-20">
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Matvælavinnslur
          </h2>
          <p class="leading-normal mt-3">
            Við bjóðum upp á allar rekstrarvörur fyrir matvælavinnslu svo sem fiskeldi, fiskvinnslu og kjötvinnslu. Má nefna vinnslufatnað, þrifafatnað, einnotafatnað, hreinlætisvörur, hnífa, brýni og olíu-og smurefni sem hlotið hafa vottun til notkunar í matvælaiðnaði. Neytendur gera miklar kröfur um hreinlæti við vinnslu matvæla og á því sviði bjóðum við einnig upp á góðar lausnir, svo sem, þrifaplön og merkingar.
          </p>
        </div>
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Strandveiðar
          </h2>
          <p class="leading-normal mt-3">
            Við bjóðum upp á heildstæða þjónustu fyrir strandveiðar, til dæmis góð veiðarfæri á borð við Mustad handfærakróka, tilbúna handfæraslóða, sökkur,  sigurnagla og sjóklæðnað.
          </p>
        </div>
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Útgerðir
          </h2>
          <p class="leading-normal mt-3">
            Við seljum allt sem skip þurfa til að halda til veiða svo sem veiðarfæri, fatnað, hreinlætisvörur. Hjá okkur færðu allt á einum stað og þú og þú einbeitir þér að því sem þú gerir best!
          </p>
        </div>
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Bændur
          </h2>
          <p class="leading-normal mt-3">
            Við erum með gott vöruúrval af rekstrarvörum fyrir bændur á hagstæðu verði eins og vinnufatnað, stígvél, slitsterka vinnuhanska, járnavöru,  hreinlætisefni, olí-og smurefni og hreinlætisáhöld.
          </p>
        </div>
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Verktakar
          </h2>
          <p class="leading-normal mt-3">
            Við erum með úrval af öryggis- og vinnufatnaði fyrir verktaka og iðnaðarmenn. Auk þess seljum við til dæmis vottaðan hífibúnað, keðjur, olíu- og smurefni, stroffur og strekkjara.
          </p>
        </div>
        <div class="bg-gray-100 rounded-md p-4">
          <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">
            Hótel og veitingarekstur
          </h2>
          <p class="leading-normal mt-3">
            Við bjóðum hótelum og veitingastöðum upp á fjölbreytt úrval af rekstrarvörum. Meðal annars er boðið upp á mikið úrval af hreinsiefnum og sápum, eldhúsvörum og salernisvörum.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container mx-auto border-t border-gray-200">
      <div class="pb-6 mb-6 sm:mt-32 sm:mb-16 sm:pb-16 flex flex-col sm:flex-row lg:justify-between border-b border-gray-200">
        @php
          $locations = App\Models\Location::all();
        @endphp
        @foreach($locations as $location)
        <article
          class="w-full lg:w-96 sm:pr-12 bg-white relative sm:border-r my-12 sm:my-0
          {{ $loop->index > 0 ? ' py-12 sm:py-0 border-t sm:border-t-0' : ''}}
          "
        >
          <h5 class="font-bold text-4xl sm:text-5xl text-gray-800 mb-6">{{ $location->name }}</h5>
          <p class="font-bold text-base text-gray-800 inline-block mb-8 voot-contact relative">Voot ehf.</p>
          <div class="con-fl justify-between">
            <div class="table-con">
                <div class="contact-info-ispod-mape">
                  <p class="font-bold text-base text-gray-800 mt-3">{{ __('default.address') }}</p>
                  <p class="text-base text-gray-800">{{ $location->address }}</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.phone') }}</p>
                  <p class="text-base text-gray-800">{{ $location->phone }}</p>
                </div>
                <div>
                  <p class="font-bold text-base text-gray-800 mt-4">{{ __('default.email') }}</p>
                  <p class="text-base text-gray-800">{{ $location->email }}</p>
                </div>
            </div>
          </div>
        </article>
        @endforeach
      </div>
      <div class="mb-16">
        <h3 class="text-xl font-bold tracking-wide leading-normal">Reykjavík</h3>
        <p class="leading-normal mt-3 mb-5">Voot rekur verslun í samstarfi við Hampiðjuna við Skarfagarð 4, 104 Reykjavík. Lögð er áhersla á gott úrval af rekstrarvörum fyrir sjávarútveg, landbúnað, matvælavinnslur og aðra starfsemi.</p>
        <h3 class="text-xl font-bold tracking-wide leading-normal">Akureyri</h3>
        <p class="leading-normal mt-3 mb-5">Voot rekur verslun við Norðurtanga 1 á Akureyri sem veitir öllu Norðurlandi þjónustu. Lögð er áhersla á gott úrval af rekstrarvörum fyrir sjávarútveg, landbúnað, matvælaiðnað og aðra starfsemi.</p>
        <h3 class="text-xl font-bold tracking-wide leading-normal">Ólafsvík</h3>
        <p class="leading-normal mt-3">Voot rekur umfangsmikla verslun við Ólafsbraut 19 í Ólafsvík. Lögð er áhersla á gott úrval af rekstrarvörum fyrir sjávarútveg, landbúnað, matvælavinnslur og aðra starfsemi en einnig sérvöru fyrir bæjarbúa. Auk þess selur verslunin efnavörur og olíur frá Olís.</p>
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
                    <span class="ml-3">Netfang</span>
                  </a>
                </div>
                <div class="-ml-px w-0 flex-1 flex">
                  <a href="tel:+354{{ $staff['phone'] }}" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-primary-lighter cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                    <span class="ml-3">Hringdu</span>
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
          <form action="/api/newsletter-registration" method="POST">
            <div class="relative flex items-center">
              <input type="email" name="user_email" placeholder="Sláðu inn netfangið þitt" class="shadow-sm focus:ring-primary-lighter focus:border-primary-lighter block w-full pr-24 py-3 border-gray-200 rounded-md">
              <div class="absolute inset-y-0 right-0 flex py-2 pr-2">
                <button type="submit" class="inline-flex items-center border border-primary-lighter bg-primary-lighter text-white rounded px-6 cursor-pointer font-sans font-medium">
                  Vertu með
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
