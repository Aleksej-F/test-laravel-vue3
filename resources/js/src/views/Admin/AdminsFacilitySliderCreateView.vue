<template>
  <div>
    <div class="wrap2 projects-title">
        <span  class="info-title">Слайдер</span>
    </div>
    
    <br/>
    <div class="slider-cont">
      <div class="slider-col-3">
        <div class="slider-block"
          v-if="projects.projectSlider && projects.projectSlider.length > 0"
        >
          <div class="slider-item"
            v-for="(item) in projects.projectSlider"
            :key="item.id"
            @click.stop="clickSelectItemSlider(item)"
            title="Кликни для редактирования"
          >
            <img class="slider-item-img" 
              :src="path + item.img" alt="">
            <div class="slider-item-select"
            v-if="item.id === sliderStore.itemSlideSelect.id"
            ></div>
          </div>
         
        </div>
        <div class="slider-block"
          v-else
        >
          <h3> Добавьте слайды</h3>
        </div>
        <div class="block-button">
            <Button
              name="Назад"
              title="Вернуться к редактированию объекта без сохранения изменений"
              visibleBack = "true"
              @click.stop="clickToBack()"
            />
            <Button
              name="Добавить"
              title="Добавить элемент в слайдер"
              @click.stop="clickCreateItemSlider()"
            
            />
            <Button
              name="Сохранить"
              title="Сохранить изменения и вернуться к редактированию объекта"
              @click.stop="clickSaveSlider()"
              v-if="changingSliders"
            />
            <Button
              name="Удалить"
              title="Удалить выбранный элемент слайдера"
              @click.stop="clickDeleteItemSlider()"
              v-if="sliderStore.itemSlideSelect.id" 
            />
            
          </div>
      </div>
      <div class="slider-cont-item" 
        v-if="'img' in sliderStore.itemSlideSelect"
      >
        <div class="project-slayder__item">
          <div  class="project-slayder__item__background">
            <img :src="'/storage/img/objects/'+route.params.id+'/'+sliderStore.itemSlideSelect.img" alt="">
            <div class="project-slayder__item__title"
            > 
              <h2>
                  {{sliderStore.itemSlideSelect.title}}
              </h2>
              <p>
                  {{sliderStore.itemSlideSelect.description}}
              </p>
            </div>
            <div  class="project-slayder__item__num">
              {{ sliderStore.itemSlideSelect.num }}/{{ projects.projectSlider.length }}
            </div>
          </div>
        </div>
        <div class="slider-cont__block">
          <div class="slider-cont-item-editpanel">
            <div
              title="Сохранить изменения"
              v-if="!theSignSelectSlideChange"
              @click.stop="clickToSaveChangesSlider()"
            >
              <svg  width="27" height="27" fill="red"  viewBox="0 0 16 16">
                <path d="M11 2H9v3h2z"/>
                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
              </svg>
            </div>

            <div :title="sliderStore.itemSlideSelect.img ? 'Изменить фоновое изображение' : 'Добавить фоновое изображение'"
              @click.stop="clickToEditImg()"
            >
                <svg  width="30" height="30" fill="#269EB7"  viewBox="0 0 16 16" >
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
            </div>
            <div 
              title="Удалить фоновое изображение"
              v-if="sliderStore.itemSlideSelect.img"
              @click="imgClickToDelete()"
            >
              <svg  width="30" height="30" fill="#269EB7"  viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
              </svg>
            </div>
          </div>
          
          <div class="slider-cont-item__description"
              :class="{'slider-cont-item__change':!theSignSelectSlideChange}"
          >
            
            <p> Заголовок </p>
            <textarea rows="2" 
                v-model= "sliderStore.itemSlideSelect.title"
                class="textarea_input" 
            ></textarea>
            <p>Описание </p>
            <textarea rows="2" 
              v-model= "sliderStore.itemSlideSelect.description"
              class="textarea_input" 
            ></textarea>
          </div>
        </div>
      </div>
      <div class="slider-cont-item" 
        v-else
      >
      Выберите слайдер для редактирования.
      </div>
    </div>
    
   
    <ImgSelected
      :path="'img/objects/' + route.params.id"
      :sliderNum="sliderStore.itemSlideSelect.num"
      v-if="imgLoadingStore.visible"
    />
    
  </div>
</template>
<script setup>
    import { useRouter, useRoute } from 'vue-router'
    import { ref, computed } from 'vue'
    import { useProjectsStore } from '../../stores/projects.js'
    
    import { onBeforeMount,onMounted, onUnmounted } from 'vue'
    import { useFacilitiesStore } from '../../stores/facilities.js'
    import { useImgLoadingStore } from '../../stores/imgLoading.js'
    import { useSliderFacilitiyStore } from '../../stores/sliderFacilitiy.js'
    import ImgSelected from '../../components/Admin/ImgSelected.vue'
    import Button from '../../components/ui/Button.vue'
    
    
    const route = useRoute()
    const router = useRouter()
    const projects = useFacilitiesStore() 
    const imgLoadingStore = useImgLoadingStore()
    const sliderStore = useSliderFacilitiyStore()

    const itemProject = ref({})

    
    const changingSliders = ref(false)
    const path = `/storage/img/objects/${route.params.id}/`


    // computed(() => projects.projectsList[0] )
    const projectHeader = computed(() => route.params.operation === "edit" ? 
      "Отредактируйте данные объекта " : "Создайте новый объект")
    const imgEditTitle = computed(() => sliderStore.itemSlideSelect.img ? 
      "Изменить фоновое изображение" : "Добавить фоновое изображение")
    
    const  theSignSelectSlideChange = computed(() =>{ 
      if ('img' in sliderStore.itemSlideSelect) {
        return (projects.projectSlider[+sliderStore.itemSlideSelect.num-1].img == sliderStore.itemSlideSelect.img) && 
        (projects.projectSlider[+sliderStore.itemSlideSelect.num-1].title == sliderStore.itemSlideSelect.title) &&
        (projects.projectSlider[+sliderStore.itemSlideSelect.num-1].description == sliderStore.itemSlideSelect.description)
      }
      return true
    })



    function imgClickToDelete() {
      sliderStore.itemSlideSelect.img = ''
    }
    function clickSelectItemSlider(item){
      sliderStore.itemSlideSelect = {...item}
      console.log(sliderStore.itemSlideSelect)
    }

    //переход к редактированию объекта
    function clickToBack() {
      sliderStore.itemSlideSelect = {}
      router.push({
        name: 'adminsFacilityDescriptionCreate', 
        params: { id: route.params.id, operation:'edit' }  
      })
    }

    // сохранение слайдера и переход к редактированию объекта
    async function clickSaveSlider() {
      // await projects.updateFacilityDatabase()
      setTimeout(() => router.push({name: 'adminsFacilities', }), 2000);
    }

    
    //открытие окна редактирования фона слайдера
    async function clickToEditImg() {
      imgLoadingStore.changeVisibility()
      await imgLoadingStore.getFilesListCatalog(`img/objects/${route.params.id}`)
    }

    async function clickDeleteItemSlider() {
      if (await sliderStore.deleteSlideDatabase(sliderStore.itemSlideSelect.id)){
        projects.projectSlider.splice(sliderStore.itemSlideSelect.num-1,1)
        sliderStore.itemSlideSelect = {}
      }

      // changingSliders.value = true
    }

    async function clickCreateItemSlider() {
      const slide = {
        description: "",
        facility_id: route.params.id,
        img: "",
        num: "",
        title: "",
      }
      await sliderStore.createSlideDatabase(slide)
    }
    async function clickToSaveChangesSlider() {
      await sliderStore.updateSlideDatabase()
      projects.projectSlider[sliderStore.itemSlideSelect.num - 1] =
      {...sliderStore.itemSlideSelect}
      sliderStore.itemSlideSelect = {}
    }
    onBeforeMount(
      async() => {
        if (!("id" in projects.projectSelect))
        await projects.getFacilitiesSlider({id:route.params.id})
        sliderStore.itemSlideSelect = {}
      }
      
    )
    onMounted( async() => {
     
      
    })
    onUnmounted(() => {
      
      
    })

    
   
</script> 

<style lang="scss" scoped>
.project{
  &-header{
    background-color: #f7f5f5;
    padding: 190px 0 20px 0px;
  }

}
  .slider{
    &-cont{
      display: flex;
      flex-wrap: wrap;
      &__block{
        position: relative;
        padding-bottom: 30px;
      }
    }
    &-col-3{
      flex: 3;
    }
    &-block{
      width: 50vw;
      height: 364px;
      border: 1px solid rgb(130, 130, 131);
      margin-right: 20px;
      padding: 5px;
      overflow-y:auto;
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
      @media  (max-width: 768px) { 
        width: 80vw;
        
      }
    }
    &-item{
      width: 80px;
      height: 80px;
      border: 2px solid #9b9999;
      position: relative;
      &-img{
        width: 100%;
        height: 100%;
      }
      &:hover{
        border: 2px solid #1dd30c;
        cursor: pointer;
      }
      &-select{
        top: 0;
        position:absolute;
        width: 100%;
        height: 100%;
        background-color: #328cb669;
        border: 2px solid rgb(223, 57, 16);
      }
    }
    &-cont-item{
      width: 355px;
      height: 364px;
      position: relative;
      @media  (max-width: 480px) { 
        width: 80vw;
        height: 40vh;
      }
      
      & img{
        width: 100%;
        height: 100%;
      }
      &__shield{
        position: absolute;
        top: 0;
        width: 100%;
        height: 100%;
      }
      &-editpanel{
        position: absolute;
        top: 15px; 
        right: 10px;
        display: flex;
        justify-content: flex-end;
        width: 100%;
        height: 20px;
        z-index: 5;
        
        & svg{
          &:hover{
            transform: scale(1.15);
            cursor: pointer;
          }
        }
      }
      
      &__description{
       
        width: 100%;
        background-color:  rgb(251 251 251 / 70%);
        border: 1px solid #575656;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        display: flex;
        text-decoration: none;
        & p {
          margin-top: 5px;
          margin-bottom: 15px;
          font-size: 20px;
          color: #0e0d0d;
        }
        & input{
          border: 1px solid #0f0f0f;
          
        }
      }
      &__change{
        background-color: rgba(255, 0, 0, 0.13);
        border: 1px solid red;
      }
      &__edit{
        
        padding: 10px;
        color: rgb(18, 39, 230);
        transition: all 0.1s ease-out;
        &-block{
          position: absolute;
          top: 0;
          right: 0;
        }
        &:hover{
          color: rgb(235, 24, 42);
          transform: scale(1.15);
        
        }
      }
    }
  }
  .block-button{
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
  }
  .slider-cont{
    display: flex;
  }
  .project-slayder{
    
    &__item{
          width: 100%;
          height: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
          background-color: #616060;
          margin-bottom: 10px;
        
          @media  (max-width: 480px) { 
            width: 80vw;
          }
        & img {
          max-width: 360px;
          max-height: 360px;
        }
        &__background{
          position: relative;
          width: 100%;
          height: 100%;
          background-size:cover;
          color:hsla(0, 13%, 94%, 0.89);
          @media  (max-width: 768px) { 
            max-height: 70vw;
            max-width: 90vw;
          }
          @media  (max-width: 480px) { 
            max-width: 80vw;
          }
        }
        &__title{
          position: absolute;
          top:250px;
          color:hsla(0, 13%, 94%, 0.89);
          
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
          color:hsla(0, 13%, 94%, 0.89);
        }
    }
  }

 

</style>