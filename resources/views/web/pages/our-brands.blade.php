@extends('layouts.default')

@section('title', __('header.our_brands'))

@section('content')
  <section>
    <div class="container mx-auto">
      <h2 class="text-4xl sm:text-6xl font-medium tracking-wide font-lora pt-12 sm:pt-20">{{ __('header.our_brands') }}</h2>
    </div>
  </section>

  <section id="categories" class="my-20">
    <div class="container">
      <img src="/images/brands/mar-wear.webp" class="h-32" alt="mar wear" />
      <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">Mar Wear</h2>
      <p class="leading-normal mt-3">
        Voot hannar og framleiðir öryggis- og vinnufatnaðinn Mar Wear. Hann er hannaður samkvæmt ströngustu kröfum um öryggi. Við þekkjum íslenskar aðstæður vel og tökum mið af þeim við hönnun á Mar Wear fatnaði.
      </p>
      <p class="leading-normal mt-3">
        Boðið er upp á öryggis- og vinnufatnað  fyrir sjómenn, matvælavinnslur, bændur og iðnaðarmenn.
      </p>
      <p class="leading-normal mt-3 mb-20">
        Fatnaður Mar Wear er seldur víða um heim. Auk Íslands er hann meðal annars seldur til Bandaríkjanna, Kanada, Skotlands, Mexíkó og víðar.
      </p>

      <img src="/images/brands/matrix.png" class="h-16" alt="mar wear" />
      <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal mt-3">Matrix</h2>
      <p class="leading-normal mt-3">
        Hollenski framleiðandinn Matrix Specialty Lubricants er framsækið fyrirtæki sem býður upp á glussa, olíu og ýmis smurefni meðal annars fyrir matvælaiðnað. Vörurnar hafa hlotið vottun til notkunar við matvælaframleiðslu. Við matvælaframleiðslu er æskilegt að nýta efni sem mega komast snertingu við svæði þar sem matvæli eru meðhöndluð til dæmis ef það kemur upp leki.
      </p>
      <p class="leading-normal mt-3">
        Matrix Specialty Lubricants var stofnað af hópi fólks sem hafði starfað um árabil hjá stóru olíu fyrirtækjunum. Þeim þóttu risarnir svifaseinir, samskipti við viðskiptavini voru af skornum skammti og þeir vörðu æ minna fjármagni í rannsóknir og þróun á nýjum vörum.
      </p>
      <p class="leading-normal mt-3">
        Stofnendur Matrix Specialty Lubricants leggja þess vegna áherslu á að eiga í nánum samskiptum við viðskiptavini, geta brugðist hratt við óskum þeirra og bjóða upp hágæða vörur sem þróaðar eru með nýjustu tækni að leiðarljósi. Starfsfólkið er sífellt að þróa nýjar hátækni vörur viðskiptavinum til hagsbóta.
      </p>
      <p class="leading-normal mt-3 mb-12">
        Matrix Specialty Lubricants leggur mikinn metnað í að að bjóða upp á rétta smurefnið við rétt tilefni. Í gegnum tíðina hefur kaupendum því miður of oft verið ráðlagt að nota efni sem byggja á gamalli tækni og hæfa því verkefninu ekki vel. Ný tækni hefur litið dagsins ljós og hún skapar viðskiptavinum mörg tækifæri.
      </p>

      <img src="/images/brands/mustad-fishing.png" class="h-20" alt="mar wear" />
      <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">Mustad</h2>
      <p class="leading-normal mt-3 mb-20">Mustad er öllum línuveiðisjómönnum um allt land vel þekkt, enda er merkið lang þekktasta vörumerki í heimi varðandi línuveiðar. Voot er umboðsaðili Mustad á íslandi og bjóðum við uppá króka til línuveiða og handfæraveiða.</p>

      <img src="/images/brands/new-pig.png" class="h-20" alt="mar wear" />
      <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">PIG</h2>
      <p class="leading-normal mt-3 mb-20">Voot er stoltur söluaðili New Pig á íslandi. Ameríska fyrirtækið New Pig sérhæfir sig í því að bæta öryggi vinnustaða með öflugu úrvali af mengunarvörnum í ýmsum útfærslum. Hjá Voot færðu gott úrval af m.a uppsogsmottum og dreglum.</p>
      <!-- <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal mt-10">Sprintus</h2> -->
      <!-- <p class="leading-normal mt-3"></p> -->
      <img src="/images/brands/fbk.jpeg" class="h-20" alt="mar wear" />
      <h2 class="text-2xl font-medium tracking-wide sm:w-2/3 leading-normal">FBK</h2>
      <p class="leading-normal mt-3">Við bjóðum uppá vönduð og endingargóð hreinlætis áhöld frá danska framleiðandanum FBK. Vörurnar fást í mörgum litum og notkun þeirra í samræmi við litakerfi minnkar líkur á krossmengun. Áhöldin bera vottanir Evrópusambandsins, BRCGS og FDA.</p>
      <p class="leading-normal mt-3">Í matvælaiðnaði skiptir höfuðmáli að geta fylgt reglum og stöðlum varðandi hreinlæti. Vottun BRCGS gefur fyrirtækjum viðurkennda vottun um um gæði, öryggi og ábyrgð. Vottunin verndar bæði fyrirtæki og neytendur og tryggir að ströngustu kröfu um matvælaöryggi sé fyllt. Fyrirtæki í matvælaiðnaði sem vilja t.d eiga viðskipti á alþjóðamarkaði ættu að huga að þessu og tryggja sér BRCGS vottun.</p>
    </div>
  </section>
  @endsection
