<template>
  <div  class="parallax" id="ecophon">
    <div class="parallax-layer ecophon_fon"></div>
    <div class="parallax-layer ecophon_fon_color" >
      
      <div 
        v-if="routViewVisible"
      >
        <div class="project-header">
          
          <div class="wrap projects-title">
            <a href="https://www.ecophon.com" target="_blank" >
              <img class="header-img" src="../assets/img/Of_distrib_eco.jpg" style="width:225px; height: 122px; ">
            </a>
            
            <span  class="info-title">Акустические потолки и стеновые панели</span>
          </div>
        </div>
        <div class="wrap" >
          <div class="description">
            Компания "ЭКО-СТРОЙ" является официальным дистрибьютором акустических материалов Ecophon.<br><br>
            Многолетний опыт работы наших сотрудников позволяет создавать комфортную акустику в помещениях, применяя самые современные, экологически чистые и эстетичные материалы.<br><br>
            Создавая комфортную акустическую среду, потолки и стеновые панели Ecophon придают помещению эксклюзивный и презентабельный внешний вид за счет большого разнообразия дизайнерских решений.
          </div>

          <TheItemEcophonRow 
            v-for="(item, index ) in listRows" 
            :key="index"
            :item="item"
          />
          
          <div class="project-header">
          
            <div class="wrap projects-title">
              <span  class="info-title">Почему акустика так важна?</span>
            </div>
          </div>
          <div class="acoustics-row">
            <div class="acoustics-col">
              <div class="description">
                Невозможно добиться ощущения комфорта вне благоприятной звуковой среды.<br><br>
                Комфортная обстановка не только полезна людям, находящимся в помещении, но и повышает работоспособность и эффективность работы компании в целом.<br><br>
                Звуки инженерных коммуникаций, работающей офисной техники, голоса - все это создает шумовое давление в виде звуковых волн,отражающихся от стен и потолка.<br><br>
              </div>
            </div>
            <div class="acoustics-col">
              <div class="acoustics-img-cont">
                <a href="https://www.ecophon.com" target="_blank" > www.ecophon.ru</a>
                <img src="../assets/img/Ecophon-звук.jpg" alt="">
              </div>
            </div>
          </div>
          
          <div class="description">
            Для создания оптимальной звуковой среды необходимо использовать различные типы звукопоглотителей.
            Звукопоглощающий потолок значительно снижает уровень звукового давления и в помещении. Однако, голые стены будут создавать эффект эха. <br><br>
            Вертикальные звукопоглотители, располагаемые на стенах, уменьшают эхо и повышают разборчивость речи, поэтому вы можете четко слышать то, что говорят люди. 
          </div>
          <div class="video-cont">
            <span>
              Послушайте, как меняется звук в офисе открытого типа 
              после установки в нем акустического потолка и стеновых
              панелей.
            </span>
            <div class="video-block">
              <iframe 
              data-src="https://www.youtube.com/embed/eF0vWDEykj4?wmode=transparent&amp;
              autoplay=0&amp;mute=0&amp;theme=dark&amp;controls=1&amp;autohide=0&amp;loop=0&amp;
              showinfo=0&amp;rel=0&amp;enablejsapi=0" 
              src="https://www.youtube.com/embed/eF0vWDEykj4?wmode=transparent&amp;
              autoplay=0&amp;mute=0&amp;theme=dark&amp;controls=1&amp;autohide=0&amp;
              loop=0&amp;showinfo=0&amp;rel=0&amp;enablejsapi=0" 
              height="100%" width="100%" frameborder="0" 
              title="External YouTube" 
              aria-label="External YouTube" 
              data-testid="youtube" 
              
            >
              
            </iframe>
            <a href="https://www.ecophon.com" target="_blank" > www.ecophon.ru</a>
            </div>
            
          </div>
        </div>
      </div>
      <div 
       v-else
      >
        
      <router-view v-slot="{ Component }">
        <transition name="fade">
          <component :is="Component" />
        </transition>
      </router-view>
      </div>
    </div>
  </div>
</template>
<script setup>
  import TheItemEcophonRow from '../components/items/TheItemEcophonRow.vue';
  import { ref, computed, watch, onMounted } from 'vue'
  import { useRoute, RouterView } from 'vue-router'
  const listRows = ref([
    {
      link:"/modular_ceilings",
      stelka:'Модульные потолки и дополнительные решения',
      textual:'Функциональные потолки выполняют роль улучшения акустики, в то же время позволяя реализовать любой замысел дизайнера',
      img:'/img/Modulnie.jpg'
    },
    {
      link:"/wall_panels",
      stelka:'Стеновые панели',
      textual:`Оптимальное решение для кинотеатров, лекционных, концертных залов и офисов типа "open-space"`,
      img:'/img/WallPanel.jpg'
    },
    {
      link:"/hanging_elements",
      stelka:'Свободно висящие элементы',
      textual:'Многообразие форм и возможность свободного размещения панелей открывают широкий просто фантазии',
      img:'/img/SoloAndBuffles.jpg'
    },

  ])
  const routViewVisible = ref(true)

  const route = useRoute()

  watch(() => route.params, (newId, oldId) => {
    
    // обработка изменения параметров маршрута...
    
    routViewVisible.value = route.name ?    true : false 
    scrolingToName()
  })

  onMounted(() => {
   
    if (!route.name ) { routViewVisible.value = false}
    scrolingToName()

  })

  function scrolingToName(ceiling, toScroll) {
    const ecophon = document.getElementById(`ecophon`)

    
    window.scrollTo(pageXOffset,0)
    ecophon.scrollTo(pageXOffset,0)
    // ecophon.scrollHeight = 0
  }

</script>
<style lang="scss" scoped>
  .parallax{
    height: 100vh;
    overflow-x: hidden;
    perspective: 1px;
    position: relative;
    &-layer{
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
    }
  }

.wrap{
  padding: 20px;
  background-color: rgb(253, 254, 255);
}
.project-header{
  
  
}
  .projects-title{
    position: relative;
    background-color: rgb(253, 254, 255);
    padding-top: 20px;
    padding-left: 20px;
    
    & span {
      display: block;
      font-size: 35px;
      width: 65%;
      @media  (max-width: 480px) { 
      margin-top: 120px;
      width: 100%;
    }
    }
  }
  @keyframes backgroundscroller {
  from {
    background-position: 0% 0%;    
  }
  to {
    background-position: 500% 500%, 400% 400%, 300% 300%, 200% 200%, 100% 100%;    
  }
}
  .ecophon{
    &_fon{
      height: 600vh;
      width: 200vw;
      background-image: url('../assets/img/Фон для Экофона.jpg');
      background-attachment: fixed, fixed;
      background-size: contain;
      background-repeat: repeat;
      transform: translateZ(-1px);
      transform-origin: 50% 0;
      left: -50%;
      top: -50%;
      &_color{
        margin-top: 18px;
        background-color: #fffbfbcf;
        z-index: 3;
        transform: translateZ(0);
      }
    }
  }
  
  .header-img{
    position: absolute;
    right: 20px;
    top: 10px;
  }
  .description{
    padding: 10px;
    
  }
  .acoustics{
    &-row{
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      @media  (max-width: 768px) { 
        justify-content: center;
      }
  
    }
    &-col{
      width: 48%;
      &:nth-child(1){
        padding-right: 30px;
        min-width: 400px;
        @media  (max-width: 480px) { 
          min-width: 100%;
        }
      }
      &:nth-child(2){
        width: 52%;
        @media  (max-width: 768px) { 
          width: 100%;
          text-align: center;
        }
        @media  (max-width: 480px) { 
          width: 100%;
          & img {
            width:100%;
          }
        }
      }
      
    }
    &-img-cont{
      position: relative;
      width: 100%;
      & a{
        position: absolute;
        text-decoration: none;
        color: rgb(255 255 255);
        left: 10px;
        bottom: 18px;
      }
    }
  }
  .video{
    &-cont{
      width: 50%;
      margin-top: 10px;
      padding: 10px;
      @media  (max-width: 768px) { 
          width: 100%;
          text-align: center;
        }
      & span {
        font-size: 20px;
        line-height: normal;
      }
    }
    &-block{
      height: 320px;
      position: relative;
      margin-top: 10px ;
      padding-left: 10px;
      & a{
        position: absolute;
        text-decoration: none;
        color: rgb(255 255 255);
        right:  10px;
        bottom: 18px;
      }
    }
  }
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.5s ease;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
</style>