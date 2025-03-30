<template>
  <div class="project-slayder__item">
    <div  class="project-slayder__item__background">
      <img :src="'/storage/img/objects/'+objectsId+'/'+item.img" alt="">
      <div class="project-slayder__item__title"
      > 
        <h2>
            {{item.title}}
        </h2>
        <p>
            {{item.description}}
        </p>
      </div>
      <div  class="project-slayder__item__num">
        {{ item.num }}/{{ sliderLength }}
      </div>
    </div>
  </div>
</template>

<script setup>
  const props = defineProps(['item', 'index', 'sliderLength', 'objectsId'])
</script>

<style lang="scss" scoped>
.project-slayder{
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
          @media  (max-width: 480px) { 
            
            width: 80vw;
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
          @media  (max-width: 480px) { 
            max-width: 80vw;
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
</style>