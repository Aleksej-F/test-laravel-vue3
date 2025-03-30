import { ref, computed } from "vue";
import { defineStore } from "pinia";

export const useProjectsStore = defineStore("projects", () => {
  const projectsList = ref([
    {
      title: "Кольская АЭС",
      h2: "Административный корпус",
      urlImg: "Kolsky NPP.png",
      id: "1",
      titleSlider: "Кольская АЭС",
      address: "Мурманская обл, г.Полярные Зори",
      workPeriod: "октябрь 2014г",
      materials: `Ecophon Focus E 600х600мм <br>
Ecophon Focus Ds 600х600мм <br>
Криволинейные переходы между уровнями потолка Ecophon Quadro <br>
Обрамляющие крыловидные эелементы Ecophon Wing <br>
Световые кессоны Ecophon Ligth Coffer с карнизным освещением <br>
Нами осуществлена поставка и шеф-монтаж потолков. <br>
Монтаж основного объема выполнен ООО"Феникс".`,
      slider: [
        {
          img: "KAES-1.jpg",
          title: "Конференц-зал",
          description: "Дизайнерский потолок Ecophon",
          id: 1,
        },
        {
          img: "KAES-2.jpg",
          title: "Конференц-зал",
          description: "Дизайнерский потолок Ecophon",
          id: 2,
        },
        {
          img: "KAES-3.jpg",
          title: "Конференц-зал",
          description: "Дизайнерский потолок Ecophon",
          id: 3,
        },
        {
          img: "KAES-4.jpg",
          title: "Конференц-зал",
          description: "Дизайнерский потолок Ecophon",
          id: 4,
        },
        {
          img: "KAES-5.jpg",
          title: "Комната для совещаний",
          description: "Световой кесон Ecophon",
          id: 5,
        },
        {
          img: "KAES-6.jpg",
          title: "Комната для совещаний",
          description: "Световой кесон Ecophon",
          id: 6,
        },
        {
          img: "KAES-7.jpg",
          title: "Монтаж Ecophon",
          description: "Сборка светового кесона",
          id: 7,
        },
        {
          img: "KAES-8.jpg",
          title: "Монтаж Ecophon",
          description: "Криволинейные переходы между уровнями потолка",
          id: 8,
        },
      ],
    },
    {
      title: "Grand Palace",
      h2: "Кинотеатр",
      urlImg: "Cinema room at the Angleterre Hotel.jpg",
      id: "2",
      titleSlider: "Кинотеатр Grand Palace",
      address: "Санкт-Петербург, Невский пр., 44",
      workPeriod: "январь 2014г",
      materials: `стены - Ecophon Texona C 600x2700x40мм<br>потолки - Ecophon Sombra Ds 1200x600мм, Sombra A 1200x600мм<br>заэкранная зона - Ecophon TAL-30 (черный)`,
      slider: [
        { img: "a2-1.jpg", title: "GrandPalaceArea", description: "", id: 1 },
        {
          img: "a2-2.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "a2-3.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "a2-4.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 4,
        },
        {
          img: "a2-5.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 5,
        },
        {
          img: "a2-6.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 6,
        },
        {
          img: "a2-7.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 7,
        },
        {
          img: "a2-8.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 8,
        },
        {
          img: "a2-9.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 9,
        },
      ],
    },
    {
      title: "Университет ИТМО",
      h2: "Актовый зал",
      urlImg: "Университет ИТМО.jpg",
      id: "3",
      titleSlider: "Университет ИТМО",
      address: "Санкт-Петербург, ул.Ломоносова, д.9",
      workPeriod: "декабрь 2015г - март 2016г",
      materials: `потолок: Ecophon Gedina A 1200х600мм, с расположением в несколько уровней<br>стены: Ecophon Vista/Texona C 2700x600мм<br>`,
      slider: [
        {
          img: "ITMO-after-1.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "ITMO-after-2.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "ITMO-after-3.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "ITMO-after-4.jpg",
          title: "Стеновые панели и потолок Ecophon",
          description: "",
          id: 4,
        },
      ],
    },
    {
      title: "Школа",
      h2: "№ 291",
      urlImg: "Школа.jpg",
      id: "4",
      titleSlider: "Школа №291",
      address:
        "Санкт-Петербург, ул.Маршала Захарова, д.16 Период работ: июль-август 2011г",
      workPeriod: "июль-август 2011г",
      materials: `актовый зал: многоуровневый подвесной потолок с криволинейным переходом Ecophon Quadro 450;
акустические стеновые панели Ecophon Akutex FT<br><br>бассейны: акустические стеновые панели Ecophon Akutex FT<br><br>спортзалы: акустические ударопрочные панели Ecophon Super G`,
      slider: [
        {
          img: "Sc-1.jpg",
          title: "Бассейн",
          description: "Стеновые панели Ecophon",
          id: 1,
        },
        {
          img: "Sc-2.jpg",
          title: "Актовый зал",
          description: "Разноуровневый потолок Ecophon",
          id: 2,
        },
        {
          img: "Sc-3.jpg",
          title: "Актовый зал",
          description: "Разноуровневый потолок Ecophon",
          id: 3,
        },
        {
          img: "Sc-4.jpg",
          title: "Актовый зал",
          description: "Разноуровневый потолок Ecophon",
          id: 4,
        },
        {
          img: "Sc-5.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 5,
        },
        {
          img: "Sc-6.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 6,
        },
        {
          img: "Sc-7.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 7,
        },
        {
          img: "Sc-8.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 8,
        },
        {
          img: "Sc-9.jpg",
          title: "Бассейн",
          description: "Стеновые панели Ecophon",
          id: 9,
        },
        {
          img: "Sc-10.jpg",
          title: "Бассейн",
          description: "Стеновые панели Ecophon",
          id: 10,
        },
      ],
    },
    {
      title: "Школа",
      h2: "№ 291 (начальная)",
      urlImg: "object_5.jpg",
      id: "5",
      titleSlider: "Школа №291 (начальная)",
      address: "Санкт-Петербург, ул.Маршала Захарова, д.14",
      workPeriod: "декабрь 2012г",
      materials: `актовый зал: многоуровневый подвесной потолок с криволинейным переходом Ecophon Quadro 450;<br>акустические стеновые панели Ecophon Akutex FT<br><br>спортзалы: акустические ударопрочные панели Ecophon Super G`,
      slider: [
        {
          img: "Sch_17-1.jpg",
          title: "Актовый зал",
          description: "Актовый зал",
          id: 1,
        },
        {
          img: "Sch_17-1.jpg",
          title: "Актовый зал",
          description: "Актовый зал",
          id: 2,
        },
        {
          img: "Sch_17-3.jpg",
          title: "Актовый зал",
          description: "Актовый зал",
          id: 3,
        },
        {
          img: "Sch_17-4.jpg",
          title: "Актовый зал",
          description: "Актовый зал",
          id: 4,
        },
        {
          img: "Sch_17-5.jpg",
          title: "Актовый зал",
          description: "Монтаж потолков Ecophon",
          id: 5,
        },
        {
          img: "Sch_17-6.jpg",
          title: "Актовый зал",
          description: "Криволинейные панели Ecophon",
          id: 6,
        },
        {
          img: "Sch_17-7.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 7,
        },
        {
          img: "Sch_17-8.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 8,
        },
        {
          img: "Sch_17-9.jpg",
          title: "Спортзал",
          description: "Стеновые панели Ecophon",
          id: 9,
        },
      ],
    },
    {
      title: "Объединенный Институт Ядерных Исследований",
      h2: "г.Дубна",
      urlImg: "object_6.jpg",
      id: "6",
      titleSlider: "Объединенный Институт Ядерных Исследований (ОИЯИ)",
      address: "Московская обл, г.Дубна",
      workPeriod: "февраль 2013г",
      materials: `Коридоры: Ecophon Focus E 600х600мм
Конференц-зал: Ecophon Focus Dg 600х600мм, расположение потолка в два уровня, обрамление карнизным профилем Edge<br><br>Монтаж на Объекте выполнен организацией ООО "КВК" (ген.директор Королев Владимир Анатольевич)`,
      slider: [
        {
          img: "dubna-1.jpg",
          title: "Потолки Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "dubna-2.jpg",
          title: "Потолки Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "dubna-3.jpg",
          title: "Потолки Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "dubna-4.jpg",
          title: "Потолки Ecophon",
          description: "",
          id: 4,
        },
        {
          img: "dubna-5.jpg",
          title: "Потолки Ecophon",
          description: "",
          id: 5,
        },
      ],
    },
    {
      title: "Госпиталь для ветеранов",
      h2: "",
      urlImg: "object_7.jpg",
      id: "7",
      titleSlider: "Госпиталь для ветеранов войн",
      address: "Санкт-петербург, ул.Народная д.21",
      workPeriod: "март-апрель 2009г",
      materials: `коридоры - гигиенические потолки Ecophon Hygiene Meditec 600х600мм, инспекционные люки Hygiene Inspection<br>
операционные - гигиенические потолки Ecophon Hygiene Protec 600х600мм, инспекционные люки Hygiene Inspection, влагозащищенные светильники Ecophon Lavanda`,
      slider: [
        {
          img: "Gospital_4.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "Gospital_1.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "Gospital_7.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "Gospital_10.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 4,
        },
        {
          img: "Gospital_9.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 5,
        },
        {
          img: "Gospital_2.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 6,
        },
        {
          img: "Gospital_8.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 7,
        },
        {
          img: "Gospital_5.jpg",
          title: "Гигиенические потолки Ecophon",
          description: "",
          id: 8,
        },
      ],
    },
    {
      title: "Call-Center Avito",
      h2: "",
      urlImg: "object_8.jpg",
      id: "8",
      titleSlider: "Call-центр Avito",
      address: "г.Санкт-Петербург, Малоохтинский пр, д.64, лит.В",
      workPeriod: "январь 2015г",
      materials: `Отдельно висящие акустические панели Ecophon SOLO Rectangle 2400х1200мм (над рабочими местами операторов)`,
      slider: [
        {
          img: "Avito-1.jpg",
          title: "Call-центр Avito",
          description: "",
          id: 1,
        },
        {
          img: "Avito-6.jpg",
          title: "Панели Ecophon Solo",
          description: "",
          id: 2,
        },
        {
          img: "Avito-4.jpg",
          title: "Панели Ecophon Solo",
          description: "",
          id: 3,
        },
        {
          img: "Avito-5.jpg",
          title: "Панели Ecophon Solo",
          description: "",
          id: 4,
        },
        {
          img: "Avito-2.jpg",
          title: "Панели Ecophon Solo",
          description: "",
          id: 5,
        },
        {
          img: "Avito-3.jpg",
          title: "Панели Ecophon Solo",
          description: "",
          id: 6,
        },
      ],
    },
    {
      title: "oodji",
      h2: "Офис компании",
      urlImg: "object_9.jpg",
      id: "9",
      titleSlider: "Офисы компании oodji",
      address: "Санкт-петербург, ул.Звездная, д.1",
      workPeriod: "июль 2012г, декабрь 2012г, август 2013г",
      materials: `стены - стеновые панели Ecophon Texona C 2700x600мм (цвет белый "Морская соль") толщиной 40мм<br>
потолок - акустические апнели Ecophon Focus E T15 толщиной 20мм + звукопоглотитель X-Bass толщиной 100мм<br>
пространство над офисными перегородками - вертикально висящие шумопоглотители Ecophon Foodtec Buffle толщиной 50мм<br>`,
      slider: [
        {
          img: "OGGI_WP-1.JPG",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "OGGI-Texona-3.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "OGGI_WP-2.JPG",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "OGGI_Buffle-932-3.jpg",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 4,
        },
        {
          img: "OGGI_Buffle-932-2.jpg",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 5,
        },
        {
          img: "OGGI_Buffle-1.JPG",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 6,
        },
        {
          img: "OGGI_Buffle-3.JPG",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 7,
        },
        {
          img: "OGGI_Buffle-4.jpg",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 8,
        },
        {
          img: "OGGI_Buffle-932-1.jpg",
          title: "Панели Ecophon Buffle",
          description: "",
          id: 9,
        },
      ],
    },
    {
      title: "Кинотеатр в гостинице Англетер",
      h2: "",
      urlImg: "object_10.jpg",
      id: "10",
      titleSlider: "Кино&Театр Англетер cinema",
      address: "Санкт-Петербург, ул. Малая Морская, д. 24",
      workPeriod: "ноябрь-декабрь 2012г",
      materials: `верх стен - Ecophon TAL-30 (серый)<br>
низ стен - Ecophon Texona (цвет "Устрица")<br>
заэкранная зона - Ecophon TAL-30 (черный)<br>`,
      slider: [
        {
          img: "Angleter-4.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "Angleter-1.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "Angleter-2.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 3,
        },
        {
          img: "Angleter-5.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 4,
        },
        {
          img: "Angleter-6.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 5,
        },
        {
          img: "Angleter-7.jpg",
          title: "Стеновые панели Ecophon",
          description: "",
          id: 6,
        },
      ],
    },
    {
      title: "Офис ",
      h2: '"ВКонтакте"',
      urlImg: "IMG-20231005-WA0001.jpg",
      id: "11",
      titleSlider: 'Офис "ВКонтакте"',
      address: "г.Москва",
      workPeriod: "февраль 2023г",
      materials: `Свободно висящие акустические панели Ecophon "СОЛО" (фигуры изготовлены на своем оборудовании).`,
      slider: [
        {
          img: "vc-1.jpg",
          title: "Свободно висящие акустические панели Ecophon",
          description: "",
          id: 1,
        },
      ],
    },
    {
      title: "Дом Культуры",
      h2: "",
      urlImg: "dk-ermilovo.jpg",
      id: "12",
      titleSlider: "Дом Культуры",
      address:
        "Ленинградская область, Выборгский район, посёлок Ермилово, Физкультурный проезд, д.5",
      workPeriod: "июль-август 2020г",
      materials: `Акустические стеновые панели Rockfon Industrial Opal 2400*1200мм с покраской в RAL на своем оборудовании.`,
      slider: [
        { img: "dk-ermilovo-1.jpg", title: "", description: "", id: 1 },
        { img: "dk-ermilovo-2.jpg", title: "", description: "", id: 2 },
        { img: "dk-ermilovo-3.jpg", title: "", description: "", id: 3 },
      ],
    },
    {
      title: "Кинотеатр",
      h2: "Dominion Cinema",
      urlImg: "k-dominion.jpg",
      id: "13",
      titleSlider: "Кинотеатр Dominion Cinema",
      address: "г. Абакан, ул. Некрасова, д.29",
      workPeriod: "май-июнь 2021г",
      materials: `Акустические панели Ecophon TAL-M 1200*600*30мм`,
      slider: [
        {
          img: "111.jpg",
          title: "Акустические панели Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "222.jpg",
          title: "Акустические панели Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "333.jpg",
          title: "Акустические панели Ecophon",
          description: "",
          id: 3,
        },
      ],
    },
    {
      title: "Кафе",
      h2: "",
      urlImg: "Ks_Res12_p01.jpg",
      id: "14",
      titleSlider: "Кафе",
      address: "Ленинградская обл, г.Кингисепп, ул. Мужества, д.4",
      workPeriod: "октябрь 2019г",
      materials: `Свободно висящие акустические панели Ecophon SOLO (фигуры изготовлены на своем оборудовании)`,
      slider: [
        {
          img: "IMG-20191024-WA0002.jpg",
          title: "Свободно висящие акустические панели Ecophon SOLO",
          description: "",
          id: 1,
        },
        {
          img: "IMG-20191024-WA0005.jpg",
          title: "Свободно висящие акустические панели Ecophon SOLO",
          description: "",
          id: 2,
        },
        {
          img: "IMG-20191024-WA0007.jpg",
          title: "Свободно висящие акустические панели Ecophon SOLO",
          description: "",
          id: 3,
        },
        {
          img: "IMG-20210103-WA0000.jpg",
          title: "Свободно висящие акустические панели Ecophon SOLO",
          description: "",
          id: 4,
        },
        {
          img: "Ks_Res12_p01.jpg",
          title: "Свободно висящие акустические панели Ecophon SOLO",
          description: "",
          id: 5,
        },
      ],
    },
    {
      title: "Кино-Досуговый центр",
      h2: 'КДЦ "ДОН"',
      urlImg: "kdz-don-3.jpg",
      id: "15",
      titleSlider: 'Кино-Досуговый центр (КДЦ "ДОН")',
      address: "Волгоградская обл, г.Серафимович, ул.Октябрьская д.57",
      workPeriod: "июнь 2021г",
      materials: `над сценой - акустический потолок Ecophon Sombra A (черный)<br>
зал - акустический потолок Ecophon Gedina A с покраской в RAL на своем оборудовании<br>
стены - акустические стеновые панели Ecophon Akutex FT 2700*1200мм с покраской в RAL на своем оборудовании<br>`,
      slider: [
        { img: "kdz-don-1.jpg", title: "", description: "", id: 1 },
        { img: "kdz-don-2.jpg", title: "", description: "", id: 2 },
        { img: "kdz-don-3.jpg", title: "", description: "", id: 3 },
      ],
    },
    {
      title: "Медицинский центр",
      h2: '"АрсВита"',
      urlImg: "mc-art-vita-3.jpg",
      id: "16",
      titleSlider: 'Медицинский центр "АрсВита"',
      address:
        "Московская обл, деревня Подолино, микрорайон Фирсановка Лайф, строение 1",
      workPeriod: "2022-2023гг",
      materials: `Акустические потолки Ecophon Gedina A, Ecophon Focus Dg`,
      slider: [
        {
          img: "mc-art-vita-1.jpg",
          title: "Акустические потолки Ecophon",
          description: "",
          id: 1,
        },
        {
          img: "mc-art-vita-2.jpg",
          title: "Акустические потолки Ecophon",
          description: "",
          id: 2,
        },
        {
          img: "mc-art-vita-3.jpg",
          title: "Акустические потолки Ecophon",
          description: "",
          id: 3,
        },
      ],
    },
    {
      title: "Технический колледж управления и коммерции",
      h2: "",
      urlImg: "IMG_20200222_125924.jpg",
      id: "17",
      titleSlider: "Технический колледж управления и коммерции",
      address: "г.Санкт-Петербург, Кондратьевский просп, д.46",
      workPeriod: "январь 2021г",
      materials: `Гибкие акустические панели "Ecophon Flexiform"`,
      slider: [
        {
          img: "IMG_20200222_125848.jpg",
          title: 'Гибкие акустические панели "Ecophon Flexiform"',
          description: "",
          id: 1,
        },
        {
          img: "IMG_20200222_125924.jpg",
          title: 'Гибкие акустические панели "Ecophon Flexiform"',
          description: "",
          id: 2,
        },
      ],
    },
    {
      title: "Офис компании",
      h2: '"Сен-Гобен"',
      urlImg: "IMG-20190708-WA0001.jpg",
      id: "18",
      titleSlider: 'Офис компании "Сен-Гобен"',
      address:
        'г.Санкт-Петербург, 10-я Красноармейская ул., д.22, БЦ "Келлерман"',
      workPeriod: "Период работ: август 2019г",
      materials: `Свободно висящие акустические панели Ecophon SOLO 1200*2400мм; 1200*1200мм`,
      slider: [
        {
          img: "IMG-20190708-WA0000.jpg",
          title: "Свободно висящие акустические панели Ecopho",
          description: "",
          id: 1,
        },
        {
          img: "IMG-20190708-WA0001.jpg",
          title: "Свободно висящие акустические панели Ecopho",
          description: "",
          id: 2,
        },
      ],
    },
    {
      title: "Стоматология",
      h2: "",
      urlImg: "IMG_20220416_123207.jpg",
      id: "19",
      titleSlider: "Стоматология",
      address: "г.Санкт-Петербург, ул. 1я Никитинская д.30",
      workPeriod: "сентябрь 2021г",
      materials: `Акустический подвесной потолок Ecophon Gedina E 1200*600мм`,
      slider: [
        {
          img: "IMG_20220416_123207.jpg",
          title: "Акустический подвесной потолок Ecophon Gedina",
          description: "",
          id: 1,
        },
        {
          img: "IMG_20220416_123325.jpg",
          title: "Акустический подвесной потолок Ecophon Gedina",
          description: "",
          id: 2,
        },
      ],
    },
    {
      title: "ГБОУ",
      h2: "школа № 717",
      urlImg: "IMG_20230316_154737.jpg",
      id: "20",
      titleSlider: "ГБОУ школа № 717",
      address: "г.Санкт-Петербург, Дальневосточный пр., д.29",
      workPeriod: "февраль 2023г",
      materials: `Акустические потолочные панели Ecophon "Фокус" 1200*600мм с покраской в RAL на своем оборудовании.<br>
Акустические панели Ecophon "Соло" для стен" 1200*2400мм`,
      slider: [
        {
          img: "IMG_20230316_154737.jpg",
          title: 'Акустические панели Ecophon "Соло" для стен',
          description: "1200*2400мм",
          id: 1,
        },
        {
          img: "IMG-20230316-WA0009.jpg",
          title: 'Акустические панели Ecophon "Соло" для стен',
          description: "1200*2400мм",
          id: 2,
        },
        {
          img: "IMG-20230316-WA0014.jpg",
          title: 'Акустические потолочные панели Ecophon "Фокус"',
          description: "1200*600мм с покраской в RAL на своем оборудовании",
          id: 3,
        },
      ],
    },
  ]);

  const count = ref(0);

  const projectsListLength = computed(() => projectsList.value.length);

  const itemProject = computed((n) => projectsList.value[n]);

  function increment() {
    count.value++;
  }

  return {
    projectsList,
    projectsListLength,
    itemProject,
    increment,
  };
});
