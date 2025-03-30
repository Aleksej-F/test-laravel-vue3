<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::create([
            'title'=> "Кольская АЭС",
            'h2'=> "Административный корпус",
            'urlImg'=> "Kolsky NPP.png",
            'id'=> "1",
            'titleSlider'=> "Кольская АЭС",
            'address'=> "Мурманская обл, г.Полярные Зори",
            'workPeriod'=> "октябрь 2014г",
            'materials'=> 'Ecophon Focus E 600х600мм <br>
                Ecophon Focus Ds 600х600мм <br>
                Криволинейные переходы между уровнями потолка Ecophon Quadro <br>
                Обрамляющие крыловидные эелементы Ecophon Wing <br>
                Световые кессоны Ecophon Ligth Coffer с карнизным освещением <br>
                Нами осуществлена поставка и шеф-монтаж потолков. <br>
                Монтаж основного объема выполнен ООО"Феникс".'
        ]);
        Facility::create( [
            'title'=> "Grand Palace",
            'h2'=> "Кинотеатр",
            'urlImg'=> "Cinema room at the Angleterre Hotel.jpg",
            'id'=> "2",
            'titleSlider'=> "Кинотеатр Grand Palace",
            'address'=> "Санкт-Петербург, Невский пр., 44",
            'workPeriod'=> "январь 2014г",
            'materials'=> 'стены - Ecophon Texona C 600x2700x40мм<br>потолки - Ecophon Sombra Ds 1200x600мм, Sombra A 1200x600мм<br>заэкранная зона - Ecophon TAL-30 (черный)',
        ]);
        Facility::create(
        [
            'title'=> "Университет ИТМО",
            'h2'=> "Актовый зал",
            'urlImg'=> "Университет ИТМО.jpg",
            'id'=> "3",
            'titleSlider'=> "Университет ИТМО",
            'address'=> "Санкт-Петербург, ул.Ломоносова, д.9",
            'workPeriod'=> "декабрь 2015г - март 2016г",
            'materials'=> 'потолок: Ecophon Gedina A 1200х600мм, с расположением в несколько уровней<br>стены: Ecophon Vista/Texona C 2700x600мм<br>',
        ]);
        Facility::create(
        [
            'title'=> "Школа",
            'h2'=> "№ 291",
            'urlImg'=> "Школа.jpg",
            'id'=> "4",
            'titleSlider'=> "Школа №291",
            'address'=>
            "Санкт-Петербург, ул.Маршала Захарова, д.16 Период работ: июль-август 2011г",
            'workPeriod'=> "июль-август 2011г",
            'materials'=> 'актовый зал: многоуровневый подвесной потолок с криволинейным переходом Ecophon Quadro 450;
                акустические стеновые панели Ecophon Akutex FT<br><br>бассейны: акустические стеновые панели Ecophon Akutex FT<br><br>спортзалы: акустические ударопрочные панели Ecophon Super G'
        ]);
        Facility::create(
        [
            'title'=> "Школа",
            'h2'=> "№ 291 (начальная)",
            'urlImg'=> "object_5.jpg",
            'id'=> "5",
            'titleSlider'=> "Школа №291 (начальная)",
            'address'=> "Санкт-Петербург, ул.Маршала Захарова, д.14",
            'workPeriod'=> "декабрь 2012г",
            'materials'=> 'актовый зал: многоуровневый подвесной потолок с криволинейным переходом Ecophon Quadro 450;<br>акустические стеновые панели Ecophon Akutex FT<br><br>спортзалы: акустические ударопрочные панели Ecophon Super G'
        ]);
        Facility::create(
        [
            'title'=> "Объединенный Институт Ядерных Исследований",
            'h2'=> "г.Дубна",
            'urlImg'=> "object_6.jpg",
            'id'=> "6",
            'titleSlider'=> "Объединенный Институт Ядерных Исследований (ОИЯИ)",
            'address'=> "Московская обл, г.Дубна",
            'workPeriod'=> "февраль 2013г",
            'materials'=> 'Коридоры: Ecophon Focus E 600х600мм
                Конференц-зал: Ecophon Focus Dg 600х600мм, расположение потолка в два уровня, обрамление карнизным профилем Edge<br><br>Монтаж на Объекте выполнен организацией ООО "КВК" (ген.директор Королев Владимир Анатольевич)'
        ]);
        Facility::create(
        [
            'title'=> "Госпиталь для ветеранов",
            'h2'=> "",
            'urlImg'=> "object_7.jpg",
            'id'=> "7",
            'titleSlider'=> "Госпиталь для ветеранов войн",
            'address'=> "Санкт-петербург, ул.Народная д.21",
            'workPeriod'=> "март-апрель 2009г",
            'materials'=> 'коридоры - гигиенические потолки Ecophon Hygiene Meditec 600х600мм, инспекционные люки Hygiene Inspection<br>
                операционные - гигиенические потолки Ecophon Hygiene Protec 600х600мм, инспекционные люки Hygiene Inspection, влагозащищенные светильники Ecophon Lavanda'
        ]);
        Facility::create(
        [
            'title'=> "Call-Center Avito",
            'h2'=> "",
            'urlImg'=> "object_8.jpg",
            'id'=> "8",
            'titleSlider'=> "Call-центр Avito",
            'address'=> "г.Санкт-Петербург, Малоохтинский пр, д.64, лит.В",
            'workPeriod'=> "январь 2015г",
            'materials'=> 'Отдельно висящие акустические панели Ecophon SOLO Rectangle 2400х1200мм (над рабочими местами операторов)'
        ]);
        Facility::create(
        [
            'title'=> "oodji",
            'h2'=> "Офис компании",
            'urlImg'=> "object_9.jpg",
            'id'=> "9",
            'titleSlider'=> "Офисы компании oodji",
            'address'=> "Санкт-петербург, ул.Звездная, д.1",
            'workPeriod'=> "июль 2012г, декабрь 2012г, август 2013г",
            'materials'=> 'стены - стеновые панели Ecophon Texona C 2700x600мм (цвет белый "Морская соль") толщиной 40мм<br>                   потолок - акустические апнели Ecophon Focus E T15 толщиной 20мм + звукопоглотитель X-Bass толщиной 100мм<br> пространство над офисными перегородками - вертикально висящие шумопоглотители Ecophon Foodtec Buffle толщиной 50мм<br>'
        ]);
        Facility::create(
        [
            'title'=> "Кинотеатр в гостинице Англетер",
            'h2'=> "",
            'urlImg'=> "object_10.jpg",
            'id'=> "10",
            'titleSlider'=> "Кино&Театр Англетер cinema",
            'address'=> "Санкт-Петербург, ул. Малая Морская, д. 24",
            'workPeriod'=> "ноябрь-декабрь 2012г",
            'materials'=> 'верх стен - Ecophon TAL-30 (серый)<br>
                    низ стен - Ecophon Texona (цвет "Устрица")<br>
                    заэкранная зона - Ecophon TAL-30 (черный)<br>'
        ]);
        Facility::create(
        [
            'title'=> "Офис ",
            'h2'=> '"ВКонтакте"',
            'urlImg'=> "IMG-20231005-WA0001.jpg",
            'id'=> "11",
            'titleSlider'=> 'Офис "ВКонтакте"',
            'address'=> "г.Москва",
            'workPeriod'=> "февраль 2023г",
            'materials'=> 'Свободно висящие акустические панели Ecophon "СОЛО" (фигуры изготовлены на своем оборудовании).'
        ]);
        Facility::create(
        [
            'title'=> "Дом Культуры",
            'h2'=> "",
            'urlImg'=> "dk-ermilovo.jpg",
            'id'=> "12",
            'titleSlider'=> "Дом Культуры",
            'address'=> "Ленинградская область, Выборгский район, посёлок Ермилово, Физкультурный проезд, д.5",
            'workPeriod'=> "июль-август 2020г",
            'materials'=> 'Акустические стеновые панели Rockfon Industrial Opal 2400*1200мм с покраской в RAL на своем оборудовании.' 
        ]);
        Facility::create(
        [
            'title'=> "Кинотеатр",
            'h2'=> "Dominion Cinema",
            'urlImg'=> "k-dominion.jpg",
            'id'=> "13",
            'titleSlider'=> "Кинотеатр Dominion Cinema",
            'address'=> "г. Абакан, ул. Некрасова, д.29",
            'workPeriod'=> "май-июнь 2021г",
            'materials'=> 'Акустические панели Ecophon TAL-M 1200*600*30мм'
        ]);
        Facility::create(
        [
            'title'=> "Кафе",
            'h2'=> "",
            'urlImg'=> "Ks_Res12_p01.jpg",
            'id'=> "14",
            'titleSlider'=> "Кафе",
            'address'=> "Ленинградская обл, г.Кингисепп, ул. Мужества, д.4",
            'workPeriod'=> "октябрь 2019г",
            'materials'=>'Свободно висящие акустические панели Ecophon SOLO (фигуры изготовлены на своем оборудовании)'
        ]);
        Facility::create(
        [
            'title'=> "Кино-Досуговый центр",
            'h2'=> 'КДЦ "ДОН"',
            'urlImg'=> "kdz-don-3.jpg",
            'id'=> "15",
            'titleSlider'=> 'Кино-Досуговый центр (КДЦ "ДОН")',
            'address'=> "Волгоградская обл, г.Серафимович, ул.Октябрьская д.57",
            'workPeriod'=> "июнь 2021г",
            'materials'=> 'над сценой - акустический потолок Ecophon Sombra A (черный)<br>
                зал - акустический потолок Ecophon Gedina A с покраской в RAL на своем оборудовании<br>
                стены - акустические стеновые панели Ecophon Akutex FT 2700*1200мм с покраской в RAL на своем оборудовании<br>'
        ]);
        Facility::create(
        [
            'title'=> "Медицинский центр",
            'h2'=> '"АрсВита"',
            'urlImg'=> "mc-art-vita-3.jpg",
            'id'=> "16",
            'titleSlider'=> 'Медицинский центр "АрсВита"',
            'address'=> "Московская обл, деревня Подолино, микрорайон Фирсановка Лайф, строение 1",
            'workPeriod'=> "2022-2023гг",
            'materials'=> 'Акустические потолки Ecophon Gedina A, Ecophon Focus Dg'
        ]);
        Facility::create(
        [
            'title'=> "Технический колледж управления и коммерции",
            'h2'=> "",
            'urlImg'=> "IMG_20200222_125924.jpg",
            'id'=> "17",
            'titleSlider'=> "Технический колледж управления и коммерции",
            'address'=> "г.Санкт-Петербург, Кондратьевский просп, д.46",
            'workPeriod'=> "январь 2021г",
            'materials'=> 'Гибкие акустические панели "Ecophon Flexiform"'
        ]);
        Facility::create(
        [
            'title'=> "Офис компании",
            'h2'=> '"Сен-Гобен"',
            'urlImg'=> "IMG-20190708-WA0001.jpg",
            'id'=> "18",
            'titleSlider'=> 'Офис компании "Сен-Гобен"',
            'address'=> 'г.Санкт-Петербург, 10-я Красноармейская ул., д.22, БЦ "Келлерман"',
            'workPeriod'=> "Период работ: август 2019г",
            'materials'=> 'Свободно висящие акустические панели Ecophon SOLO 1200*2400мм; 1200*1200мм'
        ]);
        Facility::create(
        [
            'title'=> "Стоматология",
            'h2'=> "",
            'urlImg'=> "IMG_20220416_123207.jpg",
            'id'=> "19",
            'titleSlider'=> "Стоматология",
            'address'=> "г.Санкт-Петербург, ул. 1я Никитинская д.30",
            'workPeriod'=> "сентябрь 2021г",
            'materials'=> 'Акустический подвесной потолок Ecophon Gedina E 1200*600мм'
        ]);
        Facility::create(
        [
            'title'=> "ГБОУ",
            'h2'=> "школа № 717",
            'urlImg'=> "IMG_20230316_154737.jpg",
            'id'=> "20",
            'titleSlider'=> "ГБОУ школа № 717",
            'address'=> "г.Санкт-Петербург, Дальневосточный пр., д.29",
            'workPeriod'=> "февраль 2023г",
            'materials'=> 'Акустические потолочные панели Ecophon "Фокус" 1200*600мм с покраской в RAL на своем оборудовании.<br>
                Акустические панели Ecophon "Соло" для стен" 1200*2400мм'
        ]);
        Facility::create(
            [
                'title'=>"Офис Сбербанка",
                'h2'=>'',
                'urlImg'=>'Сбербанк0.jpg',
                'id'=>'21',
                'titleSlider'=>"Административное здание \"Сбербанка\"",
                'address'=>'г.СПб, ул.Уральская д.1',
                'workPeriod'=>'февраль ноябрь 2023г - июнь 2024г',
                'materials'=>`Свободно висящие акустические панели Ecophon "Баффл Волна" (фигуры изготовлены на своем оборудовании).`
            ]);
        Facility::create(
            [
                'title'=>"Школа дзю-до им.Рахлина",
                'h2'=>'Многофункциональный спортивный комплекс',
                'urlImg'=>'Дзю-До0.jpg',
                'id'=>'22',
                'titleSlider'=>"Школа дзю-до им.Рахлина",
                'address'=>'г.СПб, ул.Замшина д.27',
                'workPeriod'=>'ноябрь 2023г - май 2024г',
                'materials'=>`Свободно висящие акустические панели "Ecophon Баффл Волна" с УФ-принтом под дерево (фигуры изготовлены на своем оборудовании)`,
                'urlVideo'=>'Дзю-До1.mp4'
            ]);
    }
}
