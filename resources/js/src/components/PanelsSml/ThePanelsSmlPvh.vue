<template>
  <div  id="pvh">
    <div class="wrap" >
      <span  class="info-title">Панели СМЛ с ПВХ покрытием</span>
    </div>
    
    <div  class="wrap fon">
      
      <div  class="description">
        Панели СМЛК на основе стекломагниевого листа с ПВХ покрытием 
        отличаются повышенной прочностью и большим пределом гибкости по 
        сравнению с гипсокартоном. 
        <hr/><br/>
        Панели трудногорючие (класс горючести КМ1 (Г1)) и обладают сравнительно 
        небольшой массой. 
        <hr/><br/>
        Широкий диапазон толщин листа СМЛ от 6 до 12 мм. позволяет применять 
        панели как для отделки стен, а так же использовать как потолочные панели.
        <hr/><br/>
        Данный тип панелей выгодно отличается тем, что не крошится не при каких 
        обстоятельствах, и практически не впитывает влагу – то есть подходит для
         отделки помещений с повышенной влажностью. Также, за счет своих характеристик,
          панели на основе СМЛ с ПВХ покрытием рекомендованы к использованию при 
          отделке спортивных и образовательных заведений, а также в медицинских 
          учреждениях и местах общественного питания.
        <hr/><br/>
        Для кашировки панелей используется стекломагнеевый лист СМЛ высшего качества Эталон (Супер-премиум).
      </div>
      
      <div class="panels-pow">
        <div class="panels-col">
          <img src="../../assets/img/panelSml/pvh.jpg" alt="">
        </div>
        <div class="panels-col">
          <div>
            <div class="characteristics"><h3>Характеристики</h3>  </div>
            <ul>
              
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