<template>
  <div class="video-item-cont" 
    :class="{'select-item-image': imgItem,'select-image': selectImgItem}"  
    @click.stop="selectVideo()"
  >
    <div class="video-item-img">
      <video  
        width="48" height="48"
        controls="controls" 
      >
        
        <source 
          :src="'/storage/'+item" 
          type='video/mp4; '
        >
        
        Тег video не поддерживается вашим браузером. 
        
      </video>
    </div>
    <div class="video-item__name">
      <p class="video-name">
        {{ nameFale }}
      </p>
      
    </div>
  </div>
</template>

<script setup>
  import { useRouter, useRoute } from 'vue-router'
  import { ref, computed } from 'vue'
  import { useImgLoadingStore } from '../../stores/imgLoading.js'
  import { useFacilitiesStore } from '../../stores/facilities.js'
  import { useSliderFacilitiyStore } from '../../stores/sliderFacilitiy.js'

  const props = defineProps(['item', 'index',])
  const route = useRoute()
  const router = useRouter()
  const imgLoadingStore = useImgLoadingStore()
  const projects = useFacilitiesStore() 
  const sliderStore = useSliderFacilitiyStore()
  // console.log(props.item)
  
  const nameFale = computed(() => props.item.split('/').pop())
  const sliderSign = computed(() => props.item.split('/')[1] === 'objects' )

  const imgItem = computed(() =>  
    nameFale.value === projects.projectSelect.urlVideo)
    
  const selectImgItem = computed(() => nameFale.value === imgLoadingStore.imageSelect)
  
  // console.log(selectImgItem.value)
  
  function selectVideo(){
    // projects.projectSelect.urlImg = nameFale.value
    imgLoadingStore.imageSelect = nameFale.value
  }
  
</script>

<style lang="scss" scoped>
  .video{
    &-item{
      &-cont{
        width: 50px;
        // height: 70px;
        margin: 5px;
        &:hover{
          cursor: pointer;
          background-color: rgba(91, 150, 185, 0.39);
          .image-item-img{
            border: 1px solid rgb(16, 106, 112);
          }
          p{}
        }
      }
      &__name{
        display: flex;
      }
      &-img{
        width: 50px;
        height: 50px;
        border: 1px solid rgb(250, 248, 248);
      }
    }
  }
  .select-item-image{
    background-color: rgba(130, 191, 231, 0.39);
  }
  .select-image{
    background-color: rgba(100, 103, 105, 0.39);
  }
  .image-name{
    word-wrap: break-word;
    font-size: 10px;
  }
</style>