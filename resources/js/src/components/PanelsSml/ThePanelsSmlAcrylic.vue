<template>
  <div  id="acrylic">
    <div class="wrap" >
      <span  class="info-title">Панели СМЛ с акриловым покрытием</span>
    </div>
    
    <div  class="wrap fon">
      
      <div  class="description">
        Стеновые панели СМЛ на основе окрашенного стекломагниевого 
        листа являются уникальными отделочным материалом  для внутренней
         отделки т.к. данный материал полностью негорючий (Класс горючести НГ),
          а главное стеновые панели СМЛ уже декорированы акриловой краской и не требуют
           дополнительной отделки после монтажа, полное отсутствие мокрых процессов.
        <hr/><br/>
        Богатство выбора расцветок для окраски СМЛ по каталогам цветов RAL и Tikkurila,
          а так же окраска в древесные и фантазийные декоры, позволяют реализовать 
          самые смелые дизайнерские решения при отделке помещений и зданий при полном
           соблюдении требований пожарной безопасности.  
        <hr/><br/>
        Для окраски используется стекло-магнезитовый лист высшего качества - СМЛ
         премиум плюс (СМЛ эталон).
        <hr/><br/>
        Лакокрасочное покрытие, применяемое для декоративных панелей, представляет 
        собой акриловую краску и лак, абсолютно пожаробезопасные, нетоксичные и
        устойчивые к внешним воздействиям.
      </div>
      
      <div class="panels-pow">
        <div class="panels-col">
          <img src="../../assets/img/panelSml/alrilovym.jpg" alt="">
        </div>
        <div class="panels-col">
          <div>
            <div class="characteristics"><h3>Характеристики</h3>  </div>
            <ul>
              <li>
                Класс горючести — от 1100 гр\см.куб
              </li>
              <li>Плотность листа — КМ0 (НГ)</li>
              <li>Ширина (мм) — 1220</li>
              <li>Длина (мм) — 2440</li>
              <li>Толщина, мм — 6, 8, 10, 12</li>
            </ul>
          </div>
          <div>
            <div class="characteristics"><h3>Преимущества</h3>  </div>
            <ul>
              <li>Трудногорючесть</li>
              <li>Влагостойкость</li>
              <li>Экологичность</li>
              <li>Легкость монтажа</li>
              <li>Устойчивость к моющим средсвам</li>
              <li>Прочность</li>
              <li>Звукопоглощение</li>
              <li>Устойчивость UV и цветостойкость</li>
            </ul>
          </div>



        </div>
      </div>
    </div>
    
  </div>
  </template>

<style lang="scss" scoped>
  .description{
    padding: 20px 0 20px 0;
  }
  .panels{
    &-pow{
      display: flex;
      column-gap: 20px;
      @media  (max-width: 768px) { 
        flex-wrap: wrap;
      }
    }
    &-col{
      flex: 2;

      &:nth-child(2){
        flex: 1;
        padding-left: 20px;
        
      }
      img{
        width: 100%;
        min-width: 460px;
        @media  (max-width: 480px) { 
          min-width: 300px;
        }
      }
      @media  (max-width: 768px) { 
        display: flex;
        justify-content: space-between;
        column-gap: 30px;
      }
      @media  (max-width: 480px) { 
        display: block;
       
      }
    }
  }
.characteristics{
  margin-top: 30px;
  margin-bottom: 15px;
  h3{
    font-weight: 600;
  }
  
}
.fon{
  border-bottom: 2px solid rgb(94, 95, 95);
  padding-bottom: 40px;
}
</style>