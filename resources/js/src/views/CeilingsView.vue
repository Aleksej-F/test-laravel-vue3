<template>
  <div class="container-parallax">
    <div class="ceilings_fon"></div>
    <div class="ceilings-container">
      <div class="wrap ceilings-wrap">
        <div class="description">
          Компания "Эко-Строй" выполняет поставку и монтаж подвесных потолков ведущих 
          производителей, любой конструкции и сложности.<br>
          В нашем ассортименте:
        </div>
      </div>
<!--       
      <TheCeilingsGrillato />
      <TheCeilingsRockfon /> -->
      <router-view v-slot="{ Component }">
        <transition name="fade">
          <component :is="Component" />
        </transition>
      </router-view>

    </div>
  </div>
</template>
<script setup>
  import TheCeilingsGrillato from '../components/TheCeilingsGrillato.vue';
  import TheCeilingsRockfon from '../components/TheCeilingsRockfon.vue';
  import { onMounted, watch } from 'vue'
  import { useRouter, useRoute, RouterView } from 'vue-router'

  const route = useRoute()
  watch(() => route.name, (newId, oldId) => {
    
    window.scrollTo(0,0)
    // const form = document.getElementById(`${newId}`)
   // обработка изменения параметров маршрута...
    // scrolingToName(newId, form.offsetTop)
  })
  // onMounted(() => {
  //   const form = document.getElementById(`${route.params.name}`)
  //   scrolingToName(route.params.name, form.offsetTop)
    
  // })

  function scrolingToName(ceiling, toScroll) {
    if (ceiling === 'grillato'){
      window.scrollTo(pageXOffset,0)
     }  else {
      window.scrollTo(pageXOffset,toScroll-200)
     }
  }
</script>
<style lang="scss" scoped>
  .ceilings{
    &-header{
      margin-top: 30px;
    }
    &-wrap{
      margin-top: 20px;
      background-color: rgb(255, 255, 255);
    }
    &-container{
      min-height: 100vh;
    } 
  }
  .description{
    margin-top: 30px;
    padding: 20px;
    font-size: 15px;
    max-width: 60vw;
    @media  (max-width: 768px) { 
      max-width: 100vw;
    }
  }
  .fade-enter-from{
      
      
      transform: translateY(300px);
  }
  .fade-enter-active{
    transition: all 1.5s ease 0.5s;
  }
  // .fade-enter-to{
    
  //   transform: translateY(0px);
    
  // }

  .fade-leave-active {
    
    
    
  }

  
  .fade-leave-to {
    opacity: 0;
    transform: translateY(-400px);
    transition: all 1s ease;
  }
</style>