<template>
  <div class="fon">
    <div class="block">
      <div class="img-list">
        <TheItemVideo
          v-for="(item, index ) in imgLoadingStore.filesList" 
          :key="item"
          :item="item"
        />
      </div>
      <div>
        <h4>Загрузить видео</h4>
        <form @submit.prevent="onSubmit">
          <input  class="" type="file" accept="video/mp4"  
            name="video"
            @change="(e)=> changeVideoLoad(e)"
            :value="imageSave"
            
          >
          <input type="hidden" 
            name="path" 
            :value="props.path"
          >
          <input type="hidden" 
            name="name" 
            :value="imageName"
          >
          <button type="submit" class="button"
            v-if="imageSave"
          >Загрузить</button>
        </form>
      </div>
      
      
    </div>
    <div class="block-button">
        
        <Button
          name="Назад"
          title='Вернуться редактированию объекта'
          visibleBack = "true"
          @click="clickToBack()"
        />
        <Button
          name="Установить"
          title="Установить выбранное видео"
          @click="clickToSaveVideo()"
          v-if="imgLoadingStore.imageSelect"
        />
        <Button
          name="Удалить"
          title="Удалить видео из каталога"
          @click="clickToDeleteVideo()"
          v-if="imgLoadingStore.imageSelect"
        />
    </div>
  </div>
</template>

<script setup>
  import { useRouter, useRoute } from 'vue-router'
  import { RouterLink, RouterView } from 'vue-router'
  import { ref, computed } from 'vue'
  import { useImgLoadingStore } from '../../stores/imgLoading.js'
  import { useFacilitiesStore } from '../../stores/facilities.js'
  import { useSliderFacilitiyStore } from '../../stores/sliderFacilitiy.js'
  import Button from '../ui/Button.vue'
  import TheItemVideo from '../items/TheItemVideo.vue'
  
  const props = defineProps(['path','sliderNum'])
  const route = useRoute()

  const imgLoadingStore = useImgLoadingStore()
  const projects = useFacilitiesStore() 
  const sliderStore = useSliderFacilitiyStore()

  const imageSave = ref()
  const imageName = ref('')
  
  function clickToBack(){
    imgLoadingStore.changeVisibility()
    imgLoadingStore.imageSelect = ''
  }

  function clickToSaveVideo(){
    projects.projectSelect.urlVideo = imgLoadingStore.imageSelect
    imgLoadingStore.changeVisibility()
    imgLoadingStore.imageSelect = ''

  }

  async function clickToDeleteVideo(){
    let name = {
      path:`${props.path}`,
      image: `${imgLoadingStore.imageSelect}`,
      idObject: ''
    }
    if (projects.projectSelect.urlVideo === imgLoadingStore.imageSelect){
      name.idObject = projects.projectSelect.id
    }
    console.log(name )
    let rez = await imgLoadingStore.deleteVideoServer(name)
    
    if (rez) {
      await imgLoadingStore.getFilesListCatalog(props.path)
      projects.projectSelect.urlVideo = ''
      imgLoadingStore.imageSelect =''
    }
  }
  //при выборе изображения для загрузки
  function changeVideoLoad(e, ind){
    if (typeof e.target.files[0] === 'object'){
      imageName.value = e.target.files[0].name
      imageSave.value = e.target.value
    }
  }

  async function onSubmit(e){
    const imgLoading = new FormData(e.target);
    // for(let [name, value] of imgLoading) {
    //     console.dir(`${name} = ${value}`)
    //   }

    await imgLoadingStore.loadVideoServer(imgLoading, props.path)
    await imgLoadingStore.getFilesListCatalog(props.path)
    imageName.value = ''
    imageSave.value = ''
  }
</script>

<style lang="scss" scoped>
.fon{
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgb(204, 206, 207);
  z-index: 20;
}
.block{
  padding: 15px;
}
.img{
  &-list{
    height: 50vh;
    width: 70vw;
    background-color: #faf8f8;
    display: flex;
    flex-wrap: wrap;
    overflow-y: auto;
  }
}
.block-button{
    margin-top: 20px;
    display: flex;
  }
</style>



