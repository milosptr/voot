<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        [
          'id' => 1,
          'name' => 'Beita',
          'description' => null,
          'slug' => 'beita',
          'parent_id' => 0,
          'order' => 0
        ],
        [
          'id' => 3,
          'name' => 'Veiðarfæri Og Útgerðarvörur',
          'description' => null,
          'slug' => 'veidjarfaeri-og-utgerdjarvorur',
          'parent_id' => 0,
          'order' => 0
        ],
        [
          'id' => 4,
          'name' => 'Goggar & Hakar',
          'description' => null,
          'slug' => 'goggar-hakar',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 5,
          'name' => 'Lína',
          'description' => null,
          'slug' => 'lina',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 6,
          'name' => 'Krókar',
          'description' => null,
          'slug' => 'krokar',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 7,
          'name' => 'Færi, Tóg & Kaðlar',
          'description' => null,
          'slug' => 'faeri-tog-kadjlar',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 8,
          'name' => 'Baujur & Belgir',
          'description' => null,
          'slug' => 'baujur--belgir',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 9,
          'name' => 'Lásar, Carabínur Fleira',
          'description' => null,
          'slug' => 'lasar-carabinur-fleira',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 10,
          'name' => 'Ýmislegt',
          'description' => null,
          'slug' => 'ymislegt',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 11,
          'name' => 'Stroffur',
          'description' => null,
          'slug' => 'stroffur',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 12,
          'name' => 'Garn & Fleira',
          'description' => null,
          'slug' => 'garn-fleira',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 13,
          'name' => 'Handfæravörur',
          'description' => null,
          'slug' => 'handfæravörur',
          'parent_id' => 3,
          'order' => 0
        ],
        [
          'id' => 14,
          'name' => 'Öryggis-og Vinnufatnaður',
          'description' => null,
          'slug' => 'oryggis-og-vinnufatnadjur',
          'parent_id' => 0,
          'order' => 0
        ],
        [
          'id' => 15,
          'name' => 'Sjófatnaður',
          'description' => null,
          'slug' => 'sjofatnadjur',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 16,
          'name' => 'Einnota Vörur',
          'description' => null,
          'slug' => 'einnota-vorur',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 17,
          'name' => 'Hanskar, Hlífar Og Annað',
          'description' => null,
          'slug' => 'hanskar-hlifar-og-annadj',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 18,
          'name' => 'Björgunar- Og Flotbúningar',
          'description' => null,
          'slug' => 'bjorgunar--og-flotbuningar',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 19,
          'name' => 'Stígvél Og Skór',
          'description' => null,
          'slug' => 'stigvel-og-skor',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 20,
          'name' => 'Vinnslufatnaður',
          'description' => null,
          'slug' => 'vinnslufatnadjur',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 21,
          'name' => 'Ýmislegt',
          'description' => null,
          'slug' => 'ymislegt',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 22,
          'name' => 'Mar Wear X Thjorsa',
          'description' => null,
          'slug' => 'mar-wear-x-thjorsa',
          'parent_id' => 14,
          'order' => 0
        ],
        [
          'id' => 23,
          'name' => 'Rekstrarvörur',
          'description' => null,
          'slug' => 'rekstrarvorur',
          'parent_id' => 0,
          'order' => 0
        ],
        ['id' =>24, 'name' => 'Hnífar & Brýni', 'slug' => 'hnifar--bryni', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>25, 'name' => 'Hreinsiefni Fyrir Matvælaiðnað', 'slug' => 'hreinsiefni-fyrir-matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>26, 'name' => 'Handhreinsikrem', 'slug' => 'handhreinsikrem', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>27, 'name' => 'Persónulegt Hreinlæti', 'slug' => 'personulegt-hreinlaeti', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>28, 'name' => 'Baðherbergishreinsun', 'slug' => 'badjherbergishreinsun', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>29, 'name' => 'Uppþvottur, Eldhús & Mötuneyti', 'slug' => 'uppþvottur,-eldhus--motuneyti', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>30, 'name' => 'Ilmefni & Tauþvottur', 'slug' => 'ilmefni--tauþvottur', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>31, 'name' => 'Ýmis Ræstiefni', 'slug' => 'ymis-raestiefni', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>32, 'name' => 'Hreinlætispappír', 'slug' => 'hreinlaetispappir', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>33, 'name' => 'Pokar & Umbúðir', 'slug' => 'pokar--umbudjir', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>34, 'name' => 'Hreinlætisáhöld', 'slug' => 'hreinlaetisahold', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>35, 'name' => 'Iðnaðarryksugur & Fleira', 'slug' => 'idjnadjarryksugur--fleira', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>36, 'name' => 'Rekstrarvörur Sem Finnast Við Málmleit', 'slug' => 'rekstrarvorur-sem-finnast-vidj-malmleit', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>37, 'name' => 'Olíu & Smurefni', 'slug' => 'oliu--smurefni', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>38, 'name' => 'Ýmsar Rekstrarvörur', 'slug' => 'ymsar-rekstrarvorur', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>39, 'name' => 'Handburstar F/Matvælaiðnað', 'slug' => 'handburstar-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>40, 'name' => 'Burstar & Kústar F/Matvælaiðnað', 'slug' => 'burstar--kustar-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>41, 'name' => 'Þvörur & Sköfur F/Matvælaiðnað', 'slug' => 'þvorur--skofur-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>42, 'name' => 'Sköft F/Matvælaiðnað', 'slug' => 'skoft-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>43, 'name' => 'Skóflur & Fötur F/Matvælaiðnað', 'slug' => 'skoflur--fotur-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>44, 'name' => 'Veggfestingar F/Matvælaiðnað', 'slug' => 'veggfestingar-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
        ['id' =>45, 'name' => 'Önnur Áhöld F/Matvælaiðnað', 'slug' => 'onnur-ahold-f/matvaelaidjnadj', 'description' => NULL, 'parent_id' => 23, 'order' => 0],
      ]);
    }
}
