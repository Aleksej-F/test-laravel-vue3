<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Facility;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    protected array $sliders = [
        '0'=>[
            [
              'img'=> "KAES-1.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'num'=> 1,
            ],
            [
              'img'=> "KAES-2.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'num'=>2,
            ],
            [
              'img'=> "KAES-3.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'num'=> 3,
            ],
            [
              'img'=> "KAES-4.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'num'=> 4,
            ],
            [
              'img'=> "KAES-5.jpg",
              'title'=> "Комната для совещаний",
              'description'=> "Световой кесон Ecophon",
              'num'=> 5,
            ],
            [
              'img'=> "KAES-6.jpg",
              'title'=> "Комната для совещаний",
              'description'=> "Световой кесон Ecophon",
              'num'=> 6,
            ],
            [
              'img'=> "KAES-7.jpg",
              'title'=> "Монтаж Ecophon",
              'description'=> "Сборка светового кесона",
              'num'=> 7,
            ],
            [
              'img'=> "KAES-8.jpg",
              'title'=> "Монтаж Ecophon",
              'description'=> "Криволинейные переходы между уровнями потолка",
              'num'=> 8,
            ],
           
          ],
        '1'=>[['img'=>'a2-1.jpg','title'=>'GrandPalaceArea','description'=>'',
          'num'=>1],['img'=>'a2-2.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'','num'=>2],
          ['img'=>'a2-3.jpg','title'=>'Стеновые панели и потолок Ecophon',
          'description'=>'','num'=>3],['img'=>'a2-4.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
          'num'=>4],['img'=>'a2-5.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
          'num'=>5],['img'=>'a2-6.jpg','title'=>'Стеновые панели и потолок Ecophon',
          'description'=>'','num'=>6],['img'=>'a2-7.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
          'num'=>7],['img'=>'a2-8.jpg','title'=>'Стеновые панели и потолок Ecophon','description'=>'','num'=>8],['img'=>'2-9.jpg','title'=>'Стеновые панели и потолок Ecophon','description'=>'','num'=>9],],
        '2'=>[['img'=>'ITMO-after-1.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
          'num'=>1],
          ['img'=>'ITMO-after-2.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'','num'=>2],
          ['img'=>'ITMO-after-3.jpg',
          'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
          'num'=>3],[
            'img'=>'ITMO-after-4.jpg',
            'title'=>'Стеновые панели и потолок Ecophon','description'=>'',
            'num'=>4],],
          '3'=>[['img'=>'Sc-1.jpg','title'=>'Бассейн','description'=>'Стеновые панели Ecophon','num'=>1],['img'=>'Sc-2.jpg','title'=>'Актовый зал','description'=>'Разноуровневый потолок Ecophon','num'=>2],['img'=>'Sc-3.jpg','title'=>'Актовый зал','description'=>'Разноуровневый потолок Ecophon','num'=>3],['img'=>'Sc-4.jpg','title'=>'Актовый зал','description'=>'Разноуровневый потолок Ecophon','num'=>4],['img'=>'Sc-5.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>5],['img'=>'Sc-6.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>6],['img'=>'Sc-7.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>7],['img'=>'Sc-8.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>8],['img'=>'Sc-9.jpg','title'=>'Бассейн','description'=>'Стеновые панели Ecophon','num'=>9],['img'=>'Sc-10.jpg','title'=>'Бассейн','description'=>'Стеновые панели Ecophon','num'=>10],],
          '4'=>[['img'=>'Sch_17-1.jpg','title'=>'Актовый зал','description'=>'Актовый зал','num'=>1],['img'=>'Sch_17-1.jpg','title'=>'Актовый зал','description'=>'Актовый зал','num'=>2],['img'=>'Sch_17-3.jpg','title'=>'Актовый зал','description'=>'Актовый зал','num'=>3],['img'=>'Sch_17-4.jpg','title'=>'Актовый зал','description'=>'Актовый зал','num'=>4],['img'=>'Sch_17-5.jpg','title'=>'Актовый зал','description'=>'Монтаж потолков Ecophon','num'=>5],['img'=>'Sch_17-6.jpg','title'=>'Актовый зал','description'=>'Криволинейные панели Ecophon','num'=>6],['img'=>'Sch_17-7.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>7],['img'=>'Sch_17-8.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>8],['img'=>'Sch_17-9.jpg','title'=>'Спортзал','description'=>'Стеновые панели Ecophon','num'=>9],],
          '5'=>[['img'=>'dubna-1.jpg','title'=>'Потолки Ecophon','description'=>'','num'=>1],['img'=>'dubna-2.jpg','title'=>'Потолки Ecophon','description'=>'','num'=>2],['img'=>'dubna-3.jpg','title'=>'Потолки Ecophon','description'=>'','num'=>3],['img'=>'dubna-4.jpg','title'=>'Потолки Ecophon','description'=>'','num'=>4],['img'=>'dubna-5.jpg','title'=>'Потолки Ecophon','description'=>'','num'=>5],],
          '6'=>[['img'=>'Gospital_4.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>1],['img'=>'Gospital_1.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>2],['img'=>'Gospital_7.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>3],['img'=>'Gospital_10.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>4],['img'=>'Gospital_9.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>5],['img'=>'Gospital_2.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>6],['img'=>'Gospital_8.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>7],['img'=>'Gospital_5.jpg','title'=>'Гигиенические потолки Ecophon','description'=>'','num'=>8],],
          '7'=>[['img'=>'Avito-1.jpg','title'=>'Call-центр Avito','description'=>'','num'=>1],['img'=>'Avito-6.jpg','title'=>'Панели Ecophon Solo','description'=>'','num'=>2],['img'=>'Avito-4.jpg','title'=>'Панели Ecophon Solo','description'=>'','num'=>3],['img'=>'Avito-5.jpg','title'=>'Панели Ecophon Solo','description'=>'','num'=>4],['img'=>'Avito-2.jpg','title'=>'Панели Ecophon Solo','description'=>'','num'=>5],['img'=>'Avito-3.jpg','title'=>'Панели Ecophon Solo','description'=>'','num'=>6],],
          '8'=>[['img'=>'OGGI_WP-1.JPG','title'=>'Стеновые панели Ecophon','description'=>'','num'=>1],['img'=>'OGGI-Texona-3.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>2],['img'=>'OGGI_WP-2.JPG','title'=>'Стеновые панели Ecophon','description'=>'','num'=>3],['img'=>'OGGI_Buffle-932-3.jpg','title'=>'Панели Ecophon Buffle','description'=>'','num'=>4],['img'=>'OGGI_Buffle-932-2.jpg','title'=>'Панели Ecophon Buffle','description'=>'','num'=>5],['img'=>'OGGI_Buffle-1.JPG','title'=>'Панели Ecophon Buffle','description'=>'','num'=>6],['img'=>'OGGI_Buffle-3.JPG','title'=>'Панели Ecophon Buffle','description'=>'','num'=>7],['img'=>'OGGI_Buffle-4.jpg','title'=>'Панели Ecophon Buffle','description'=>'','num'=>8],['img'=>'OGGI_Buffle-932-1.jpg','title'=>'Панели Ecophon Buffle','description'=>'','num'=>9],],
          '9'=>[['img'=>'Angleter-4.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>1],['img'=>'Angleter-1.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>2],['img'=>'Angleter-2.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>3],['img'=>'Angleter-5.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>4],['img'=>'Angleter-6.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>5],['img'=>'Angleter-7.jpg','title'=>'Стеновые панели Ecophon','description'=>'','num'=>6],],
          '10'=>[['img'=>'vc-1.jpg','title'=>'Свободно висящие акустические панели Ecophon','description'=>'','num'=>1],],
          '11'=>[['img'=>'dk-ermilovo-1.jpg','title'=>'','description'=>'','num'=>1],['img'=>'dk-ermilovo-2.jpg','title'=>'','description'=>'','num'=>2],['img'=>'dk-ermilovo-3.jpg','title'=>'','description'=>'','num'=>3],],
          '12'=>[['img'=>'111.jpg','title'=>'Акустические панели Ecophon','description'=>'','num'=>1],['img'=>'222.jpg','title'=>'Акустические панели Ecophon','description'=>'','num'=>2],['img'=>'333.jpg','title'=>'Акустические панели Ecophon','description'=>'','num'=>3],],
          '13'=>[['img'=>'IMG-20191024-WA0002.jpg','title'=>'Свободно висящие акустические панели Ecophon SOLO','description'=>'','num'=>1],['img'=>'IMG-20191024-WA0005.jpg','title'=>'Свободно висящие акустические панели Ecophon SOLO','description'=>'','num'=>2],['img'=>'IMG-20191024-WA0007.jpg','title'=>'Свободно висящие акустические панели Ecophon SOLO','description'=>'','num'=>3],['img'=>'IMG-20210103-WA0000.jpg','title'=>'Свободно висящие акустические панели Ecophon SOLO','description'=>'','num'=>4],['img'=>'Ks_Res12_p01.jpg','title'=>'Свободно висящие акустические панели Ecophon SOLO','description'=>'','num'=>5],],
          '14'=>[['img'=>'kdz-don-1.jpg','title'=>'','description'=>'','num'=>1],['img'=>'kdz-don-2.jpg','title'=>'','description'=>'','num'=>2],['img'=>'kdz-don-3.jpg','title'=>'','description'=>'','num'=>3],],
          '15'=>[['img'=>'mc-art-vita-1.jpg','title'=>'Акустические потолки Ecophon','description'=>'','num'=>1],['img'=>'mc-art-vita-2.jpg','title'=>'Акустические потолки Ecophon','description'=>'','num'=>2],['img'=>'mc-art-vita-3.jpg','title'=>'Акустические потолки Ecophon','description'=>'','num'=>3],],
          '16'=>[['img'=>'IMG_20200222_125848.jpg','title'=>'Гибкие акустические панели "Ecophon Flexiform"','description'=>'','num'=>1],['img'=>'IMG_20200222_125924.jpg','title'=>'Гибкие акустические панели "Ecophon Flexiform"','description'=>'','num'=>2],],
          '17'=>[['img'=>'IMG-20190708-WA0000.jpg','title'=>'Свободно висящие акустические панели Ecopho','description'=>'','num'=>1],['img'=>'IMG-20190708-WA0001.jpg','title'=>'Свободно висящие акустические панели Ecopho','description'=>'','num'=>2],],
          '18'=>[['img'=>'IMG_20220416_123207.jpg','title'=>'Акустический подвесной потолок Ecophon Gedina','description'=>'','num'=>1],['img'=>'IMG_20220416_123325.jpg','title'=>'Акустический подвесной потолок Ecophon Gedina','description'=>'','num'=>2],],
          '19'=>[[
            'img'=>'IMG_20230316_154737.jpg',
            'title'=>'Акустические панели Ecophon "Соло" для стен',
            'description'=>'1200*2400мм',
            'num'=>1],
            ['img'=>'IMG-20230316-WA0009.jpg',
            'title'=>'Акустические панели Ecophon "Соло" для стен',
            'description'=>'1200*2400мм',
            'num'=>2],
            ['img'=>'IMG-20230316-WA0014.jpg',
            'title'=>'Акустические потолочные панели Ecophon "Фокус"',
            'description'=>'1200*600мм с покраской в RAL на своем оборудовании',
            'num'=>3],],
          '20'=>[
            ['img'=>'Сбербанк1.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>1],
            ['img'=>'Сбербанк2.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>2],
            ['img'=>'Сбербанк2.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>3],
            ['img'=>'Сбербанк4.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>4],
          ],
          '21'=>[
            ['img'=>'Дзю-До1.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>1],
            ['img'=>'Дзю-До2.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>2],
            ['img'=>'Дзю-До3.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>3],
            ['img'=>'Дзю-До4.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>4],
            ['img'=>'Дзю-До5.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>5],
            ['img'=>'Дзю-До6.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>6],
            ['img'=>'Дзю-До7.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>7],
            ['img'=>'Дзю-До8.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>8],
            ['img'=>'Дзю-До9.jpg',
            'title'=>'',
            'description'=>'',
            'num'=>9],
          ]

        ];

    public function run(): void
    {
      $facilities = Facility::all();
      //  dd(count($this->sliders[0]));
      //  dd(count($facilities));
      for ($i=0; $i < count($facilities); $i++) { 
        for ($j=0; $j < count($this->sliders[$i]); $j++) { 
          Slider::factory($this->sliders[$i][$j])
          ->afterMaking(function (Slider $slider) use ($facilities, $i ) {
            $slider->facility()->associate($facilities[$i]['id']);
            
          })
          ->create();
          // ->create(['facility_id' => $facilities[$i]['id']]);
        
      };
        
      };

      $slide = Slider::all();
      dd($slide);
    }
}
