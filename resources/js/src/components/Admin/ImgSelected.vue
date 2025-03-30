<template>
  <div class="fon">
    <div class="block">
      <div class="img-list">
        <TheItemImg
          v-for="(item, index ) in imgLoadingStore.filesList" 
          :key="item"
          :item="item"
        />
      </div>
      <div>
        <h4>Загрузить изображение</h4>
        <form @submit.prevent="onSubmit">
          <input  class="" type="file" accept="image/*"  
            name="image"
            @change="(e)=> changeImgLoad(e)"
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
          :title="props.path === 'img' ? 
            'Вернуться к объектам не сохраняя изменения' :
            'Вернуться к слайдеру не сохраняя изменения'"
          visibleBack = "true"
          @click="clickToBack()"
        />
        <Button
          name="Установить"
          :title="props.path === 'img' ? 
            'Установить изображение на фон объекта' :
            'Установить изображение на фон слайда'"
          @click="clickToSaveImg()"
        />
        <Button
          name="Удалить"
          title="Удалить изображение из каталога"
          @click="clickToDeleteImg()"
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
  import TheItemImg from '../items/TheItemImg.vue'
  
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

  function clickToSaveImg(){
    
    if (props.path === 'img') {
      projects.projectSelect.urlImg = imgLoadingStore.imageSelect
    } else {
      console.log(sliderStore.itemSlideSelect)
      sliderStore.itemSlideSelect.img = imgLoadingStore.imageSelect
    }
    
    imgLoadingStore.changeVisibility()
    imgLoadingStore.imageSelect = ''
  }

  async function clickToDeleteImg(){
    let name = {
      path:`${props.path}`,
      image: `${imgLoadingStore.imageSelect}`,
      idObject: ''
    }
    if (projects.projectSelect.urlImg === imgLoadingStore.imageSelect){
      name.idObject = projects.projectSelect.id
    }
    console.log(name )
    let rez = await imgLoadingStore.deleteImageServer(name)
    
    if (rez) {
      await imgLoadingStore.getFilesListCatalog(props.path)
      if (projects.projectSelect.urlImg === imgLoadingStore.imageSelect){
        projects.projectSelect.urlImg = ''
      } else if (sliderStore.itemSlideSelect.img === imgLoadingStore.imageSelect){
        sliderStore.itemSlideSelect.img = ''
      }
      imgLoadingStore.imageSelect =''
    }
  }
  //при выборе изображения для загрузки
  function changeImgLoad(e, ind){
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

    await imgLoadingStore.loadImageServer(imgLoading, props.path)
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



