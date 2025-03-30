<template>
  <div class="container-parallax">
    <div class="ceilings_fon"></div>
    <div class="ceilings-container">
      <div class="wrap ceilings-wrap">
        <div class="description">
          Компания "Эко-Строй" выполняет поставку и монтаж стеновых панелей СМЛ (стекломагниевые листы).<br>
          В нашем ассортименте:
        </div>
      </div>
      
      <ThePanelsSmlAcrylic />
      <ThePanelsSmlPvh />
      <ThePanelsSmlPolymer />
      
    </div>
  </div>
</template>
<script setup>
  import ThePanelsSmlAcrylic from '../components/PanelsSml/ThePanelsSmlAcrylic.vue';
  import ThePanelsSmlPvh from '../components/PanelsSml/ThePanelsSmlPvh.vue';
  import ThePanelsSmlPolymer from '../components/PanelsSml/ThePanelsSmlPolymer.vue';
  import { onMounted, watch } from 'vue'
  import { useRouter, useRoute } from 'vue-router'

  const route = useRoute()

  watch(() => route.params.name, (newId, oldId) => {
    
    const form = document.getElementById(`${newId}`)
    // обработка изменения параметров маршрута...
    scrolingToName(newId, form.offsetTop)
  })

  onMounted(() => {
    const form = document.getElementById(`${route.params.name}`)
    scrolingToName(route.params.name, form.offsetTop)
  })

  function scrolingToName(ceiling, toScroll) {
    // const element = document.querySelector(`#${ceiling}`)
    const element = document.querySelector(`#${ceiling}`)
    
    // element.scrollIntoView( {behavior: "smooth", block: "start"})
    if (ceiling === 'acrylic'){
      window.scrollTo(0,0)
     }  else {
      // element.scrollIntoView()
      window.scrollTo(0,toScroll-130)
      console.log(ceiling, toScroll)
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

</style>