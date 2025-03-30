<template>
  <div  id="grillato">
    <div class="wrap" >
      <span  class="info-title">Потолки "Грильято"</span>
    </div>
    <div class="wrap" >
      <div class="grillato-description">
        Решетчатая конструкция потолка "Грильято" - это экономичный, эффектный и практичный
        способ оформления потолков в общественных пространствах, торговых и офисных помещениях.
      </div>
      <div class="grillato-container__img">
        <div class="grillato-container__img_col">
          <img src="../assets/img/g111.png" alt="">
        </div>
        <div class="grillato-container__img_col">
          <img src="../assets/img/g222.jpg" alt="">
        </div>
      </div>
      <div class="grillato-container__img">
        <div class="grillato-container__img_col">
          <b>Предлагаем Грильято отечественных производителей:</b>
          <ul>
            <li>
              - Подвесные потолки грильято Албес
            </li>
            <li>
              - Подвесные потолки грильято Цесал
            </li>
            <li>
              - Подвесные потолки грильято Центрстройсвет
            </li>
          </ul>
          <b>Стандартные размеры ячейки, которые поддерживаются на складе:</b>
          <ul>
            <li>
              - Потолки грильято 50х50 мм,
            </li>
            <li>
              - Потолки грильято 75х75 мм,
            </li>
            <li>
              - Потолки грильято 100х100 мм.
            </li>
          </ul>
          <b>Стандартные цвета:</b>
          <ul>
            <li>
              - белый
            </li>
            <li>
              - черный
            </li>
            <li>
              - серебристый
            </li>
            <li>
              - графит
            </li>
            <li>
              - бежевый
            </li>
            <p>Окраска в другие цвета по катологу RAL - по запросу.</p>
          </ul>
          
        </div>
        <div class="grillato-container__img_col">
          <b>Большую популярность завоева конструкция потолка "ГРИЛЬЯТО GL 15":</b>
          <p >
            Принцип монтажа аналогичен подвесным потолкам типа Армстронг - собранные
            предварительно квадратные секции потолка Грильято размером 600х600 мм
            вкладываются в уже смонтированную подвесную систему на Т-образном каркасе
          </p>
          <img class="grillato-img_gl15" src="../assets/img/g333.jpg" alt="">
        </div>
      </div>
      <div class="grillato-container__img">
        <div class="grillato-container__img_col_painted">
          <img class="grillato-img_painted" src="../assets/img/g666.jpg" alt="">
        </div>
        <div class="grillato-container__img_col_painted">
          <img class="grillato-img_painted" src="../assets/img/g555.jpg" alt="">
        </div>
        <div class="grillato-container__img_col_painted ">
          <img class="grillato-img_painted" src="../assets/img/g444.jpg" alt="">
        </div>
      </div> 
      <div class="grillato-container__domino">
        <b>Светильники "Домино" для потолков Грильято </b>
        <div class="grillato-container__domino__row">
          <div class="grillato-container__domino__col">
            <p>
              "Домино" - универсальный светильник, предназначен для использования в помещениях
              различного назначения, оборудованных потолочной системой Грильято, таких как:
              торговые и бизнес центры, аэропорты, холлы и коридоры.<br>
              Преимущество такого светильника в том, что потолок остается нетронутым - под 
              светильник не нужно выпиливать отверстия. Просто вставляем в ячейку потолка и 
              монтаж на этом закончен. Остается соединить
              все светильники в цепочку и подключить их к блоку питания.
            </p>
          </div>
          <div class="grillato-container__domino__col">
            <div class="grillato-container__domino__row">
              <div class="grillato-container__domino__col_img">
                <img class="grillato-img_domino" src="../assets/img/domino-1.jpg" alt="">
              </div>
              <div class="grillato-container__domino__col_img">
                <img class="grillato-img_domino" src="../assets/img/domino-2.jpg" alt="">
              </div>
              <div class="grillato-container__domino__col_img">
                <img class="grillato-img_domino" src="../assets/img/domino-3.jpg" alt="">
              </div>
            </div>
          </div>

        </div>
      </div>   
    </div>
  </div>
</template>

<script setup>
  

</script>
<style lang="scss" scoped>
  .grillato{
    &-description{
      margin-top: 30px;
      font-size: 20px;
      @media  (max-width: 768px) { 
        font-size: 15px;
      }
    }
    &-container{
      &__img{
        display: flex;
        margin: 30px 0;
        flex-wrap: wrap;
        justify-content: center;
        &_col{
          flex: 1;
          min-width: 300px;
          font-size: 20px;
          line-height: 23px;
          &_painted{
            height: 300px;
            max-width: 300px;
          }
          @media  (max-width: 768px) { 
            font-size: 15px;
           
          }

          & img {
            width: 100%;
            min-width: 330px;
          }
          & ul{
            list-style: none;
            margin-bottom: 20px;
            padding-top: 5px;
          }
          & b{
            font-weight: bold;
          }
        }
      }
      &__domino{
        font-size: 20px;
        line-height: 23px;
        margin-bottom: 50px;
        @media  (max-width: 768px) { 
          font-size: 15px;
        }  

        & b{
          font-weight: bold;
        }
        &__row{
          display: flex;
          flex-wrap: wrap;
          margin-top: 30px;
          justify-content: center;
          column-gap: 20px;
            row-gap: 20px;
          @media  (max-width: 768px) { 
            column-gap: 20px;
            row-gap: 20px;
          }  
        }
        &__col{
          flex: 2;
          min-width: 320px;
          &:nth-child(2){
            flex:4;
            @media  (max-width: 480px) { 
              flex:2;
            }
          }
          &_img{
            flex: 1;
            min-width: 200px;
            max-width: 217px;
            height: 217px;
            overflow: hidden ;
            
            @media  (max-width: 480px) { 
              max-width: 300px;
              height: 300px;
            }
            // display: flex;
            // justify-content: center;
           
          }
        }
      }
    }
    &-img{
      &_gl15{
        margin-top: 20px;
        height: 210px;
      }
      &_painted{
        height: 100%;
        width: 100%;
      }
      &_domino{
        height: 100%;
        width: 100%;
        margin: 0 auto;
        
      }
    }
  }
</style>