<template>
  <div v-if="successfulDownload">
    <div class="project-header">
        <div class="wrap2 projects-title">
            <span  class="info-title">{{itemProject.titleSlider}}</span>
        </div>
    </div>
    <div class="wrap ">
        <div class="project-row">
            <div class="project-col">
                <b>Адрес:</b>
                <p>{{itemProject.address}}</p>
                <b>Период работ:</b>
                <p>{{itemProject.workPeriod}}</p>
                <b>Материалы:</b>
                <p
                    v-html="itemProject.materials"  
                ></p>
                
            </div>
            <div class="project-col"
              v-if="itemProject.sliders.length > 0"
            >
                <div class="project-slayder-open"
                  v-if="slayderOpenVisible"
                >
                  <div class="project-slayder-open__button"
                    @click.stop="setOpenSliderItem(-1)"
                  >
                    <svg  width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                  </div>
                  <div class="project-slayder-open__button"
                    @click.stop="setOpenSliderItem(1)"
                  >
                    <svg  width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                  </div>
                  <div class="project-slayder-open__button"
                    @click.stop="closeSlayderOpen"
                  >
                    <svg width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                      <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                    </svg>
                  </div>
                  <div class="project-slayder-open__cont">
                    <div class="project-slayder-open__item">
                      <div  class="project-slayder-open__item__background"
                        :style="{
                          opacity: opacityItemOpenSlider,
                          transition: 'opacity '+shiftOpacityItemOpenSlider+'s ease 0s'
                        }"
                      >
                        <img :src="'/storage/img/objects/'+itemProject.id+'/'+sliderOpenActiveSlider.img" alt="">
                        <div class="project-slayder-open__item__title"
                        > 
                          <h2>
                              {{sliderOpenActiveSlider.title}}
                          </h2>
                          <p>
                              {{sliderOpenActiveSlider.description}}
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          
                <div class="project-slayder">
                    <div class="project-slayder__button"
                      @click.stop="setSliderItem(-1)"
                    >
                      <svg  width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                      </svg>
                    </div>
                    <div class="project-slayder__button _right"
                      @click.stop="setSliderItem(1)"
                    >
                      <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                    </div>
                    <div class="project-slayder__cont"
                      :style="{
                        transform: 'translateX('+shift+'vw)',
                        transition: 'transform '+shiftSpeed+'s ease 0s'
                      }"
                       @click.stop="sliderToScreen(sliderItem)"

                    >
                        <TheItemProjectsSlider 
                            v-for="(item, index ) in getSliderList(sliderItem)" 
                            :key="index"
                            :item="item"
                            :sliderLength="itemProject.sliders.length"
                            :objectsId = "itemProject.id"
                       />
                       
                    </div>  
                    <TheItemProjectsSlider 
                      @click.stop="sliderToScreen(sliderItem)"
                      class="project-slayder__item_visible"
                      :class="classObject"
                      :item="activeSlider"
                      :sliderLength="itemProject.sliders.length"
                      :objectsId = "itemProject.id"
                      /> 
                </div>
            </div>
        </div>
        <div class="project-row">
            <div class="project-col">
                
                <div class="project-button__cont">
                  <a href="/#projects" class="project-button__link">
                      НАЗАД К ПРОЕКТАМ
                  </a>
                </div>
            </div>
            <div class="project-col">
              <div class="project-video"
                v-if="itemProject.urlVideo"
              >
                <video  
                  controls="controls" 
                  :poster="'/storage/img/'+itemProject.urlImg"
                >
                 
                  <source 
                    :src="'/storage/video/'+itemProject.urlVideo" 
                    type='video/mp4; '
                  >
                  
                  Тег video не поддерживается вашим браузером. 
                  
                </video>
              </div>
          
                
            </div>
        </div>
    </div>
  </div>
</template>
<script setup>
    import { useRouter, useRoute } from 'vue-router'
    import { ref, computed } from 'vue'
    import { useProjectsStore } from '../stores/projects.js'
    import TheItemProjectsSlider from '../components/items/TheItemProjectsSlider.vue'
    import { onBeforeMount,onMounted, onUnmounted } from 'vue'
    import { useFacilitiesStore } from '../stores/facilities.js'
    
    const shiftSpeed = ref(0.6) //время смены слайда сек
    const shiftFrequency = ref(5) // через какое время менять слайды сек
    const opacityItemOpenSlider = ref(1) //переменная для задания отображения слайда открытого слайдера
    const shiftOpacityItemOpenSlider = ref(0.6) //время смены слайда открытого слайдера сек
    const shift = ref(-32)
    const shiftOpions = ref(-32)
    const route = useRoute()
    const sliderItem = ref(0)
    const timerId = ref([])
    const intervalId = ref([])
    const isActive = ref(true)
    const clickButton = ref(false)
    const slayderOpenVisible = ref(false)
    const sliderOpenItem = ref(0)
    const successfulDownload = ref(false)
    const classObject = computed(() => ({
      'project-slayder__item_novisible': isActive.value
    }))
    // const projects = useProjectsStore() 
    const projects = useFacilitiesStore() 
    
    // const itemProject = computed(() => projects.projectsList[+route.params.id-1] )
    const itemProject = computed(() => projects.projectsList[0] )

    const activeSlider = ref({})
    
    const sliderOpenActiveSlider = ref({})

    function getSliderList(params) {
      let sliders = []
      if (params === 0){
        sliders.push(itemProject.value.sliders.at(-1))
        sliders = sliders.concat(itemProject.value.sliders.slice(params,params+2))
      } else if (params === itemProject.value.sliders.length-1){
        sliders = sliders.concat(itemProject.value.sliders.slice(params-1))
        sliders.push(itemProject.value.sliders[0])
      } else {
        sliders = (itemProject.value.sliders.slice(params-1,params+2))
      }
      return sliders
    }

    function clearTimeoutInterval() {
      
      intervalId.value.forEach((element) => {
        clearInterval(element)
      });
      intervalId.value=[]
      timerId.value.forEach((element) => {
        clearTimeout(element)
      });
      timerId.value=[]
    }

    function setSliderItem(params, manual=true) {
      
      if (manual ) {
        clearTimeoutInterval()
      }
      clickButton.value = true
        if ( params === 1){
          shift.value = shiftOpions.value*2
          timerId.value.push(
            setTimeout(() => {
              if (sliderItem.value < itemProject.value.sliders.length-1){
                activeSlider.value = itemProject.value.sliders[sliderItem.value+1]
                isActive.value = false
                sliderItem.value += 1
              } else {
                activeSlider.value = itemProject.value.sliders[0]
                isActive.value = false
                sliderItem.value = 0 
              }
            }, shiftSpeed.value * 1000)
          )
        }else{
          shift.value = 0
          timerId.value.push(setTimeout(() => {
            isActive.value = false
            if (sliderItem.value > 0){
              activeSlider.value = itemProject.value.sliders[sliderItem.value-1]
              isActive.value = false
              sliderItem.value -= 1
            }else {
              activeSlider.value = itemProject.value.sliders[itemProject.value.slider.length-1]
              isActive.value = false
              sliderItem.value = itemProject.value.sliders.length-1
            }
          }, shiftSpeed.value * 1000))
        }
        timerId.value.push(setTimeout(() => {
          shift.value = shiftOpions.value   
          timerId.value.push(setTimeout(() => {
            isActive.value = true 
            clickButton.value = false
            if (manual ) {
              intervalId.value.push( setInterval(() => setSliderItem(1, false), shiftFrequency.value*1000))
            }
          }, shiftSpeed.value * 1000))
          
        }, shiftSpeed.value * 2000) )     
      
    }

    function sliderToScreen(item){
      
      clearTimeoutInterval()
      sliderOpenItem.value = item
      sliderOpenActiveSlider.value = itemProject.value.sliders[sliderOpenItem.value]
      slayderOpenVisible.value = true
    }

    function closeSlayderOpen(){
      slayderOpenVisible.value = false
      intervalId.value.push( setInterval(() => setSliderItem(1, false), shiftFrequency.value*1000))
    }

    function setOpenSliderItem(params) {
      opacityItemOpenSlider.value = 0 
      setTimeout(() => {
        if ( params === 1){
          if (sliderOpenItem.value < itemProject.value.sliders.length-1){
            sliderOpenItem.value += 1
          } else {
            sliderOpenItem.value = 0
          }
        } else {
          if (sliderOpenItem.value > 0 ){
            sliderOpenItem.value -= 1
          } else {
            sliderOpenItem.value = itemProject.value.sliders.length-1
          }
        }

        sliderOpenActiveSlider.value = itemProject.value.sliders[sliderOpenItem.value]
        opacityItemOpenSlider.value = 1
      }, shiftOpacityItemOpenSlider.value * 1000)
      
    }
    onBeforeMount(
      async() => {
       
        await projects.getFacilitiesSlider({id:route.params.id})
        
        if (itemProject.value.length > 0) {
          activeSlider.value = itemProject.value.sliders[0]
          sliderOpenActiveSlider.value = itemProject.value.sliders[0]
        }
        
        successfulDownload.value = true
      }
    )
    onMounted( async() => {
      if (itemProject.value.length > 0) {
        intervalId.value.push( setInterval(() => setSliderItem(1, false), shiftFrequency.value*1000))
        const slider = document.getElementsByTagName('body')[0].clientWidth
        if (slider < 768) {
          shiftOpions.value= -90
          shift.value= -90
        }
        if (slider < 480) {
          shiftOpions.value= -80
          shift.value= -80
        }
      }
    })
    onUnmounted(() => {
      intervalId.value.forEach((element) => clearInterval(element));
      
    })

    
   
</script> 

<style lang="scss" >
.project{
  &-header{
    background-color: #f7f5f5;
    padding: 190px 0 20px 0px;
  }
  &-row{
    display: flex;
    margin-top: 50px;
    margin-bottom: 20px;
    column-gap: 20px;
    font-size: 18px;
    @media  (max-width: 768px) { 
      flex-wrap: wrap;
    }
  }
  
  &-col{
    width: 50%;
    margin: 20px;
    
    @media  (max-width: 768px) { 
      width: 100%;
      margin-bottom: 30px;
      }
    &:nth-child(2){
      width: 50%;
      @media  (max-width: 768px) { 
        width: 100%;
        flex-wrap: wrap;
        display: flex;
        justify-content: center;
      
      }
    }
    & b{
        font-weight: 600;
    }
    & p {
      margin: 3px 0 30px 0;
      &:nth-child(6){
        line-height: 1.5;
      }
    }
  }
  &-button{
    &__cont{
      display: flex;
      justify-content: center;
      align-items: center;
    }
    &__link{
      color: #edcd1f;
      background-color: #3b3a3a;
      padding: 15px;
      text-transform: uppercase;
      text-decoration: none;
      transition:  all 0.4s ease 0s;
      &:hover{
        background-color: #edcd1f;
        color: #3b3a3a;
      }
    }
  }
  &-slayder{
    
    height: 24vw;
    width: 32vw;
    position: relative;
    display: inline-block;
    border: 1px solid #727171  ;
    overflow: hidden;
    @media  (max-width: 768px) { 
      height: 70vw;
      width: 90vw;
    }
    @media  (max-width: 480px) { 
      height: 70vw;
      width: 80vw;
    }
    &:hover{
        cursor: pointer;
        .project-slayder__item__title, .project-slayder__item__num{
            color: hsla(0, 13%, 94%, 0.89);
        }
    }
    &-open{
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgb(37 35 35 / 88%);
      z-index: 120;
      &__button{
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 100%;
        color: #fcf9f9;
        z-index: 10;
        &:nth-child(1){
          left: 30px;
          @media  (max-width: 768px) {
            left: 0px;
          }
        }
        &:nth-child(2){
          right: 49px;
          @media  (max-width: 768px) {
            right: 0px;
          }

        }
        &:nth-child(3){
          right: 39px;
          top: 45px;
          height: 40px;
          & svg{
            transform: rotate(0);
            transition: transform .5s ease 0s;
          }
          &:hover svg{
            transform: rotate(180deg);
          }
        }
        &:hover{
          cursor: pointer;
          
        }
      
      }
      &__item{
        height: 100vh;
        width: 100vw;
        display: flex;
        align-items: center;
        justify-content: center;
        
        &_visible{
          position: absolute;
          top: 0;
          z-index: 7;
        }
        &_novisible{
          opacity: 0;
          display: none;
        }
        & img {
          max-width: 70vw;
          max-height: 50vw;
          @media  (max-width: 768px) {
            max-width: 100vw;
            max-height: 75vw;
          }
          @media  (max-width: 480px) {
            max-width: 80vw;
            max-height: 75vw;
          }
        }
        &__background{
          position: relative;
          background-origin: content-box;
          max-width: 70vw;
          max-height: 57vw;
          background-size:cover;
          text-align: center;
          @media  (max-width: 768px) {
            max-width: 100vw;
            max-height: 75vw;
          }
          @media  (max-width: 480px) {
            max-width: 80vw;
            max-height: 75vw;
          }
        }
        &__title{
          width: 100%;
          color: hsl(0, 100%, 99%);
          bottom: 0px;
          text-align: center;
          & h2 {
            margin: 20px auto;  
            font-size: 16px;
          }
          & p{
            margin: 20px auto; 
            font-size: 12px;
          }
        }
      }
    }
    &__button{
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 20px;
      height: 100%;
      color: #3b3a3a;
      z-index: 10;
      &:nth-child(1){
        left: 0;
      }
      &:nth-child(2){
        right: 0;
      }
      &:hover{
        & svg {
            width:20px; 
            height:20px;  
        }
        
      }
     
    }
    &__cont{
      height: 24vw;
      width: 2000px; 
      display: flex;
      transform: translateX(-32vw);
      transition:  transform 0.6s ease 0s;
      @media  (max-width: 768px) { 
        height: 70vw;
      }

    }
    &__item{
        height: 24vw;
        width: 32vw;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #616060;
        @media  (max-width: 768px) { 
          height: 70vw;
          width: 90vw;
        }
        &_visible{
          position: absolute;
          top: 0;
          z-index: 7;
        }
        &_novisible{
          opacity: 0;
          display: none;
        }
      & img {
        max-width: 32vw;
        max-height: 24vw;
        @media  (max-width: 768px) { 
          max-height: 70vw;
          max-width: 90vw;
        }
      }
      &__background{
        position: relative;
        background-origin: content-box;
        max-width: 32vw;
        max-height: 24vw;
        background-size:cover;
        @media  (max-width: 768px) { 
          max-height: 70vw;
          max-width: 90vw;
        }
      }
      &__title{
        position: absolute;
        color: hsla(0, 1%, 14%, 0);
        transition:  all 0.3s ease 0s;
        bottom: 7px;
        & h2 {
          margin-left: 10px;  
          font-size: 17px;
          
        }
        & p{
            margin: 0;
            margin-left: 10px; 
            font-size: 15px;
        }
      }
      &__num{
        position: absolute;
        top:0;
        right: 0;
        color: hsla(0, 1%, 14%, 0);
      }
    }
    
  }
  &-video{
   & video{
      width:400px;
      height:300px; 
      @media  (max-width: 450px) {
        width:320px;
      }
    }
  }
}
</style>