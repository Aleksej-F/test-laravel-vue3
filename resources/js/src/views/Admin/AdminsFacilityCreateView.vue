<template>
  <div>
    <div class="wrap2 projects-title">
        <span  class="info-title">{{ projectHeader }}</span>
    </div>
    
    <br/>

    <div class="projects-cont-item" date_num="1" >
      <img 
        :src="'/storage/img/'+projects.projectSelect.urlImg" 
        alt=""
        v-if="projects.projectSelect.urlImg"
      >
      <div class="projects-cont-item-editpanel"
      
      >
        <div :title="projects.projectSelect.urlImg ? 'Изменить фоновое изображение' : 'Добавить фоновое изображение'"
          @click.stop="clickToEditImg()"
        >
            <svg  width="30" height="30" fill="#269EB7"  viewBox="0 0 16 16" >
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
        </div>
        <div 
          title="Удалить фоновое изображение"
          v-if="projects.projectSelect.urlImg"
          @click="imgClickToDelete()"
        >
          <svg  width="30" height="30" fill="#269EB7"  viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
          </svg>
        </div>
      </div>
        <div class="projects-cont-item__description">
          
          <h2> 
            {{ projects.projectSelect.title == "" ? "Введите название": 
              projects.projectSelect.title}}
          </h2>
          <input type="text"
            v-model="projects.projectSelect.title"
          >
          <p>
            {{ projects.projectSelect.h2 == "" ? "Введите описание": projects.projectSelect.h2}}
          </p>
          <input type="text"
            v-model="projects.projectSelect.h2"
          >
          
        </div>
    </div>
    <div class="block-button">
      <Button
        name="Назад"
        title="Вернуться к объектам без сохранения изменений"
        visibleBack = "true"
        @click.stop="clickToBack()"
      />
      <Button
        name="Сохранить"
        title="Сохранить изменения и вернуться к объектам"
        @click.stop="clickSaveProject()"
      />
    </div>
   
    <ImgSelected
      path="img"
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
    
    import Button from '../../components/ui/Button.vue'

    const route = useRoute()
    const router = useRouter()
    const projects = useFacilitiesStore() 
    const imgLoadingStore = useImgLoadingStore()
    
    const itemProject = ref({})
    

    // computed(() => projects.projectsList[0] )
    const projectHeader = computed(() => route.params.operation === "edit" ? 
      "Отредактируйте данные объекта " : "Создайте новый объект")
    const imgEditTitle = computed(() => itemProject.urlImg ? 
      "Изменить фоновое изображение" : "Добавить фоновое изображение")

    function imgClickToDelete() {
      projects.projectSelect.urlImg = ''
    }

    function clickToBack() {
      router.push({name: 'adminsFacilities', })
    }

    async function clickSaveProject() {
      if (theSignObjectChange()){
        console.log('true')
      } else {
        console.log('false')
        if (route.params.operation === "edit"){
          await projects.updateFacilityDatabase()
        } else {
          await projects.setFacilityDatabase()
        }
      }
      setTimeout(() => router.push({name: 'adminsFacilities', }), 2000);
    }

    function theSignObjectChange(){
      return  (projects.projectSelect.urlImg == itemProject.value.urlImg) && 
       (projects.projectSelect.title == itemProject.value.title) &&
       (projects.projectSelect.h2 == itemProject.value.h2)
    }
    
    async function clickToEditImg() {
      console.log(imgLoadingStore.visible)
      imgLoadingStore.changeVisibility()
      await imgLoadingStore.getFilesListCatalog('img')
    }

    onBeforeMount(
      async() => {
        console.log(itemProject.value)
        if (route.params.operation === "edit"){
         await projects.getFacilitiesSlider({id:route.params.id})
         
        }else{
          await projects.setNewFacilitiesCreate()
          console.log(itemProject.value)
          
        }
        itemProject.value = {... projects.projectSelect }
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
  .projects-cont-item{
    width: 455px;
    height: 464px;
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
      top: 0;
      display: flex;
      justify-content: flex-end;
      width: 100%;
      height: 20px;
      z-index: 5;
      padding: 20px;
      & svg{
        &:hover{
          transform: scale(1.15);
          cursor: pointer;
        }
      }
    }
    &__description{
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      background-color:  rgb(251 251 251 / 70%);
      border: 1px solid #575656;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      display: flex;
      text-decoration: none;
      & h2{
        font-size: 30px;
        font-weight: 600;
        text-align: center;
        color: #0e0d0d;
      }
      & p {
        margin-top: 10px;
        font-size: 20px;
        color: #575656;
      }
      & input{
        border: 1px solid #0f0f0f;
      }
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
  .block-button{
    margin-top: 20px;
    display: flex;
  }
  
 

 

</style>