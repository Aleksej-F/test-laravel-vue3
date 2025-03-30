<template>
  <div class="row">
    <div class="col">
      <RouterLink :to="'/ecophon'+item.link" class="stelka-link">
        <div class="stelka-cont">
          
          <div class="stelka">
            <span>
              {{ item.stelka }}
            </span>
          </div>

          <div class="stelka__sharper"></div>
        </div>
      </RouterLink>
      <div class="textual">
        {{ item.textual }}
      </div>
    </div>
    <div class="col">
      <div class="img-cont">
        <a href="https://www.ecophon.ru" target="_blank" > www.ecophon.ru</a>
        <img :src=" item.img " alt="">
      </div>
     
    </div>
  </div>
</template>
<script setup>
  import { RouterLink } from 'vue-router'
  const props = defineProps(['item', 'index'])
</script>

<style lang="scss" scoped>
  .row{
    display: flex;
    margin: 20px 0 20px 0 ;
    justify-content: space-between;
    flex-wrap: wrap;
    @media  (max-width: 768px) { 
      justify-content: center;
      }
  }
  .col{
    width: 50%;
    min-width: 360px;
    display: flex;
    justify-content: center;
    align-items: start;
    flex-direction:column;
    margin: 30px 0;
    @media  (max-width: 480px) { 
      min-width: 320px;
    }
    &:nth-child(2){
      
      width: 45%;
      & img {
        height: 100%;
        width: 95%;
      }
    }
  }
  .stelka{
    transition:  all 0.4s ease 0s;
    color: rgb(20, 20, 20);
    &-cont{
      width: 100%;
      position: relative;
      height: 50px;
      &:hover {
        & .stelka, .stelka__sharper{
        background-color: #0b1a72;
        color: rgb(252, 250, 248);}
        
      }
    }
    &-link{
      width: 100%;
    }
    background-color: #edcd1f;
    width: 98%;
    height: 50px;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    
    z-index: 5;
    & span {
      width: 100%;
      overflow: hidden;
      text-overflow: clip;
      text-align: center;
      margin-left: 20px;
      white-space: nowrap;
    }
    &__sharper{
      transition:  all 0.4s ease 0s;
      display: block;
      position: absolute;
      
      top: 7px;
      right: -9px;
      width: 36px;
      height: 36px;
      background-color: #edcd1f;
      transform: rotate(45deg);
      z-index: 1;
      
    }
  }
  .textual{
    width: 88%;
    margin-top: 20px;
    padding-left: 30px;
    font-size: 15px;
    line-height: normal;
  }
  .img-cont{
    position: relative;
    & a{
      position: absolute;
      text-decoration: none;
      color: black;
      left: 10px;
    }
  }
</style>