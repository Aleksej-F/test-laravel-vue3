<template>
 <div class="header">
    <TheLoader/>
    <MessageView/>
    <div class="header-logo">
      <RouterLink to="/">
        <img src="../assets//img/logo.png" alt="">
      </RouterLink>
    </div>
    <div class="wrap header-wrap">
      <div class="header-header">
        <div class="header-header-contacts">.</div>
        <div class="header-header-title">
          <h2>Акустика помещений</h2>
          <h2>Подвесные потолки</h2>
        </div>
        <div class="header-header-contacts">
          <div class="header-header-contacts__row">
            <img src="../assets/img/ico telephone.png" alt="">
            <p>(812) 919-78-86</p>
          </div>
          <div class="header-header-contacts__row">
            <img src="../assets/img/ico address.png" alt="">
            <p>пр.Елизарова д.34Б оф.319</p>
          </div>
          <div class="header-header-contacts__row">
          <p>info.ecostroi@mail.ru</p>
          </div>
        </div>
        <div class="header-burger"
          :class="{'active':active}"
          @click="active = !active"
        >
          <span></span>
        </div>
      </div>
      <div class="header-menu "
        :class="{'active':active}"
        @click="active = false"
      >
        <ul class="header-menu__ul">
          <li class="header-menu__li ">
            <RouterLink to="/"
            class="header-menu__li__a"
            >Главная</RouterLink>
          </li>
          <li class="header-menu__li ">
            <div 
              @click.stop="clickElementMenu('/ecophon')"
              class="header-menu__li__a"
            >ecophon</div>
            <div class="ceilings">
              <div class="ceilings__menu ceilings__menu_ecophon">
                <ul class="ceilings__menu__ul">
                  <li 
                    class="ceilings__menu__li"
                    v-for="(item, index ) in listEcophon"
                    :key="index"
                  >
                    <RouterLink :to="`/ecophon${item.link}`"
                      class="ceilings__menu__a"
                    >{{ item.name }}</RouterLink>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="header-menu__li ">
            <div 
              @click.stop="clickElementMenu('/ceilings/grillato')"
              class="header-menu__li__a"
            >Потолки</div>
            <div class="ceilings">
              <div class="ceilings__menu ">
                <ul class="ceilings__menu__ul">
                  <li 
                    class="ceilings__menu__li"
                    v-for="(item, index ) in listceilings"
                    :key="index"
                  >
                    <RouterLink :to="`/ceilings${item.link}`"
                      class="ceilings__menu__a"
                    >{{ item.name }}</RouterLink>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="header-menu__li ">
            <div 
              @click.stop="clickElementMenu('/panels-sml/acrylic')"
              class="header-menu__li__a"
            >СМЛ-панели</div>
            <div class="ceilings">
              <div class="ceilings__menu ceilings__menu_ecophon">
                <ul class="ceilings__menu__ul">
                  <li 
                    class="ceilings__menu__li"
                    v-for="(item, index ) in listpanels"
                    :key="index"
                  >
                    <RouterLink :to="`/panels-sml${item.link}`"
                      class="ceilings__menu__a"
                    >{{ item.name }}</RouterLink>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="header-menu__li ">
            <a href="/#services" class="header-menu__li__a">Услуги</a>
          </li>
          <li class="header-menu__li ">
            <a href="/#projects" class="header-menu__li__a">Объекты</a>
          </li>
          <li class="header-menu__li ">
            <a href="/#contacts" class="header-menu__li__a">контакты</a>
          </li>
        </ul>
      </div>
    </div>
  </div >
  <div class="header-lining"></div>
</template>

<script setup>
  defineProps({
    
  })
  import TheLoader from './ui/LoaderView.vue';
  import MessageView from "./ui/MessageView.vue"
  import { ref, computed } from 'vue'
  import { useRouter, RouterLink } from 'vue-router'
  const active = ref(false)
  const router = useRouter()
  const listceilings = ref ([
    {
      name:'грильято',
      link:'/grillato',
    },
    {
      name:'rockfon',
      link:'/rockfon',
    },
    {
      name:'НГ-Акустик',
      link:'/acoustics',
    },
  ])

  const listEcophon = ref ([
  {
      name:'потолки',
      link:'/modular_ceilings',
    },
    {
      name:'стеновые панели',
      link:'/wall_panels',
    },
    {
      name:'Свободно висящие панели',
      link:'/hanging_elements',
    },
  ])
  const listpanels = ref ([
    {
      name:'С акриловым покрытием',
      link:'/acrylic',
    },
    {
      name:'С ПВХ покрытием',
      link:'/pvh',
    },
    {
      name:'С полимерным покрытием',
      link:'/polymer',
    },
  ])

  function clickElementMenu(link){
   
   if (window.innerWidth > 480){
         router.push(link)
   }
   
 }
</script>

<style lang="scss" scoped>
  .wrap2 {
  margin: 0 auto;
  max-width: 940px;
  @media  (max-width: 768px) { 
    max-width: 90vw;
  }

}
.header{
  position: fixed;
  background-color: #002e5d;
  width: 100%;
  z-index: 100;
  &-lining{
    height: 156px;
    @media  (max-width: 768px) { 
      height: 107px;
      
    }
    @media  (max-width: 480px) { 
      height: 70px;
    }
  }
  &-substrate{
    padding-top: 110px;
  }
  &-logo{
    position: absolute;
    left: 0;
    top: 0;
    height: 75%;
    background-color: rgb(237, 205, 31);
    padding-left: 20px;
    @media  (max-width: 768px) { 
      height: 70%;
      
    }
    @media  (max-width: 480px) { 
      height: 80%;
    }
    & img {
      height: 100%;
      @media  (max-width: 768px) { 
        margin-left: -20px;
      }
    }
  }
  &-header{
    display: flex;
    justify-content: center;
    align-items: center;
    &>div{
      flex: 1;
    }
    &-title{
      margin-top: 20px;
      text-align: center;
      @media  (max-width: 480px) { 
        margin-top: 10px;
      }
      & h2{
        color: #edcd1f;
        font-size: 1.5vw;
        line-height: 1.1em;
        font-weight: bold;
        margin-bottom: 20px;

        @media  (max-width: 480px) { 
          font-size: 3.8vw;
          margin-bottom: 9px;
        }
        
      }
    }
    &-contacts{
      font-size: 1.1vw;
      margin: auto 0 auto 20px;
      @media  (max-width: 768px) { 
        font-size: 1.7vw;
      }
      @media  (max-width: 480px) { 
        display: none;
      }
      &__row{
        display: flex;
        align-items: center;
        margin-bottom: 5px;
        & p{
          margin-left: 10px;
          font-size:1em;
          color: #faf9f7;
        }
        & img {
          height: 2.2vw;
          width: 2.2vw;
        }
        &:nth-child(3){
          & p{
            margin-left: 50px;
            font-size: 0.8em;
            
          }
        }
      }
    }
    
  }

  &-menu{
    
    @media  (max-width: 480px) { 
      position: absolute;
      transform: scaleY(0);
      transform-origin: top;
      transition:  all 0.3s ease 0s;
      background-color: #edcd1f;
      right: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100vw;
      height: 94vh;
      &.active {
        transform: scaleY(1);
      }
    }
    @media  (max-width: 768px) { 
      margin-top: 0px;
    }
    &__ul{
      display: flex;
      justify-content: center;
      list-style: none;
      @media  (max-width: 480px) {
        flex-direction: column;

      }
      
    }
      &__li{
        margin: 0 5px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-top: 1px solid #ffffff;
        padding-top: 5px;
        @media  (max-width: 480px) {
          margin: 2vh 5px;
          padding-top: 4vh;
        }
        &__a{
          padding: 0px 11px;
          font-size: 1vw;
          line-height: 2vw;
          font-weight: 700;
          letter-spacing: 0.025em;
          text-transform: uppercase;
          color: #ffffff;
          text-decoration: none;
          @media  (max-width: 480px) {
            font-size: 17px;
            line-height: 18px;
            margin-top: 5px;
            padding: 10px;
          }
          
        }
        &:hover{
          & .header-menu__li__a {color: #edcd1f;
          
          @media  (max-width: 480px) {
            color:#002e5d;
          }
          }
          border-top: 4px solid #edcd1f;
          padding-top: 2px;
          @media  (max-width: 480px) {
            border-top: 4px solid #002e5d;
            padding-top: calc(4vh - 3px);
          }
          
          & .ceilings__menu{
            transform: scaleY(100%);
          }
        }
        
    }
  }
  &-burger{
    display: none;
    & span{
      position: absolute;
      background-color: #fff;
      width: 100%;
      height: 2px;
      left: 0;
      top: 9px;
      transition: all 0.3s ease 0s;
    }
    &::after,&::before{
      content: '';
      background-color: #fff;
      position: absolute;
      width: 100%;
      height: 2px;
      left: 0;
      transition: all 0.3s ease 0s;
    }
    &::after {
      bottom: 0;
    }
    &::before {
      top: 0;
    }
    &:hover{
      cursor: pointer;
    }
    &.active span{
      transform: scale(0);
    }
    &.active::before{
      transform: rotate(45deg);
      top: 9px;
    }
    &.active::after{
      transform: rotate(-45deg);
      bottom: 9px;
    }
    @media (max-width: 480px) {
      display: block;
      width: 30px;
      height: 20px;
      position: absolute;
      right: 20px;
      z-index: 15000;  
    }
  }
}
.ceilings{
  position: relative;
  &__menu{
    position: absolute;
    transform: scaleY(0%);
    transform-origin:top;
    background-color: #002e5d;
    transition:  all 0.3s ease 0s;
    &_ecophon{
      @media (max-width: 480px) {
        left: -50%;
      }
    }
    &__ul{
      display: block;
      list-style: none;
    }
    &__li{
      margin: 10px ;
      white-space: nowrap;
      &:hover{
        & .ceilings__menu__a{
          color: #edcd1f;
        }
          
       
      }
    }
    &__a{
      text-decoration: none;
      text-transform: uppercase;
      color: #ffffff;
      padding: 5px 11px;
      margin-top: 5px;
    }
  }

   
  
}
</style>