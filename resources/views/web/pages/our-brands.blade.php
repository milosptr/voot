@extends('layouts.default')

@section('title', __('header.our_brands'))

@section('content')
  <section>
    <div class="container mx-auto">
      <h2 class="text-4xl sm:text-6xl font-medium tracking-wide font-lora pt-12 sm:pt-20 capitalize">{{ __('header.our_brands') }}</h2>
    </div>
  </section>

  <section id="categories" class="mt-10 mb-20">
    <div class="container">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center items-center mb-20"></a>
        <a href="http://www.marwear.is" target="_blank"><img src="/images/brands/mar-wear.webp" class="h-32" alt="mar wear" /></a>
        <a href="https://www.matrix-lubricants.com/" target="_blank"><img src="/images/brands/matrix.png" class="h-16" alt="matrix" /></a>
        <a href="https://mustadautoline.com/" target="_blank"><img src="/images/brands/mustad-fishing.png" class="h-20" alt="mustad fishing" /></a>
        <a href="https://www.newpig.com/" target="_blank"><img src="/images/brands/new-pig.png" class="h-20" alt="new pig" /></a>
        <a href="http://en.fbk.dk/" target="_blank"><img src="/images/brands/fbk.jpeg" class="h-20" alt="fbk" /></a>
        <a href="https://baltic.se/en/" target="_blank"><img src="/images/brands/baltic.webp" class="h-20" alt="baltic" /></a>
        <a href="https://fladenfishing.se/en/" target="_blank"><img src="/images/brands/fladen.webp" class="" alt="fladen" /></a>
        <a href="https://www.hansenprotection.no/en/" target="_blank"><img src="/images/brands/hansen.webp" class="h-14" alt="hansen" /></a>
      </div>

      <div class="grid grid-col-1 lg:grid-cols-2 gap-8">
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Mar Wear</h2>
          <p class="leading-normal mt-2">
            Voot hannar og framleiðir öryggis- og vinnufatnaðinn Mar Wear. Hann er hannaður samkvæmt ströngustu kröfum um öryggi. Við þekkjum íslenskar aðstæður vel og tökum mið af þeim við hönnun á Mar Wear fatnaði.
          </p>
          <p class="leading-normal mt-3">
            Boðið er upp á öryggis- og vinnufatnað  fyrir sjómenn, matvælavinnslur, bændur og iðnaðarmenn.
          </p>
          <p class="leading-normal mt-3 mb-10">
            Fatnaður Mar Wear er seldur víða um heim. Auk Íslands er hann meðal annars seldur til Bandaríkjanna, Kanada, Skotlands, Mexíkó og víðar.
          </p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Matrix</h2>
          <p class="leading-normal mt-2">
            Hollenski framleiðandinn Matrix Specialty Lubricants er framsækið fyrirtæki sem býður upp á glussa, olíu og ýmis smurefni meðal annars fyrir matvælaiðnað. Vörurnar hafa hlotið vottun til notkunar við matvælaframleiðslu. Við matvælaframleiðslu er æskilegt að nýta efni sem mega komast snertingu við svæði þar sem matvæli eru meðhöndluð til dæmis ef það kemur upp leki.
          </p>
          <p class="leading-normal mt-3">
            Matrix Specialty Lubricants var stofnað af hópi fólks sem hafði starfað um árabil hjá stóru olíu fyrirtækjunum. Þeim þóttu risarnir svifaseinir, samskipti við viðskiptavini voru af skornum skammti og þeir vörðu æ minna fjármagni í rannsóknir og þróun á nýjum vörum.
          </p>
          <p class="leading-normal mt-3">
            Stofnendur Matrix Specialty Lubricants leggja þess vegna áherslu á að eiga í nánum samskiptum við viðskiptavini, geta brugðist hratt við óskum þeirra og bjóða upp hágæða vörur sem þróaðar eru með nýjustu tækni að leiðarljósi. Starfsfólkið er sífellt að þróa nýjar hátækni vörur viðskiptavinum til hagsbóta.
          </p>
          <p class="leading-normal mt-3 mb-10">
            Matrix Specialty Lubricants leggur mikinn metnað í að að bjóða upp á rétta smurefnið við rétt tilefni. Í gegnum tíðina hefur kaupendum því miður of oft verið ráðlagt að nota efni sem byggja á gamalli tækni og hæfa því verkefninu ekki vel. Ný tækni hefur litið dagsins ljós og hún skapar viðskiptavinum mörg tækifæri.
          </p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Mustad</h2>
          <p class="leading-normal mt-2 mb-10">Mustad er öllum línuveiðisjómönnum um allt land vel þekkt, enda er merkið lang þekktasta vörumerki í heimi varðandi línuveiðar. Voot er umboðsaðili Mustad króka á Íslandi og bjóðum við uppá króka til línuveiða og handfæraveiða.</p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">PIG</h2>
          <p class="leading-normal mt-2 mb-10">Voot er stoltur söluaðili New Pig á Íslandi. Ameríska fyrirtækið New Pig sérhæfir sig í því að bæta öryggi vinnustaða með öflugu úrvali af mengunarvörnum í ýmsum útfærslum. Hjá Voot færðu gott úrval af m.a uppsogsmottum og dreglum.</p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">FBK</h2>
          <p class="leading-normal mt-2">Við bjóðum uppá vönduð og endingargóð hreinlætis áhöld frá danska framleiðandanum FBK. Vörurnar fást í mörgum litum og notkun þeirra í samræmi við litakerfi minnkar líkur á krossmengun. Áhöldin bera vottanir Evrópusambandsins, BRCGS og FDA.</p>
          <p class="leading-normal mt-3 mb-10">Í matvælaiðnaði skiptir höfuðmáli að geta fylgt reglum og stöðlum varðandi hreinlæti. Vottun BRCGS gefur fyrirtækjum viðurkennda vottun um um gæði, öryggi og ábyrgð. Vottunin verndar bæði fyrirtæki og neytendur og tryggir að ströngustu kröfu um matvælaöryggi sé fyllt. Fyrirtæki í matvælaiðnaði sem vilja t.d eiga viðskipti á alþjóðamarkaði ættu að huga að þessu og tryggja sér BRCGS vottun.</p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Fladen</h2>
          <p class="leading-normal mt-2">Við bjóðum uppá meðfærilega og endingargóðan flotvinnufatnað frá sænska framleiðandanum Fladen. Vörur Fladen eru hannaðar og þróaðar í svíþjóð til að standast ströngustu kröfur ym öryggi og gæði.</p>
          <p class="leading-normal mt-3 mb-10">Flotvinnufatnaðurinn frá Fladen er líklega einn sá vinsælasti á íslandi og er á viðráðanlegu verði án þess að slegið sé af öryggiskröfum. </p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Hansen Protection</h2>
          <p class="leading-normal mt-2 mb-10">Við bjóðum uppá gott úrval af björgunarvestum frá norska framleiðandanum Hansen Protection. Frramleiðandinn býr yfir 140 ára reynslu af framleiðslu á hágæða öryggisfatnaði sem stenst ítrustu kröfur.</p>
        </div>
        <div class="bg-gray-100 rounded-lg p-4">
          <h2 class="text-3xl font-medium tracking-wide sm:w-2/3 leading-normal">Baltic</h2>
          <p class="leading-normal mt-2">Við höfum uppá að bjóða mjög breitt úrval af björgunar og flotvinnubúningum frá sænska framleiðandanum Baltic Lifejackets. Baltic leggur mikið uppúr sportlegri og flottri hönnun og hvort sem að þú ert að leita að björgunarvesti fyrir árbátinn í bústaðnum, eða fyrir áhöfnina á togaranum, þá eigum við það til.</p>
        </div>
      </div>

    </div>
  </section>
  @endsection
