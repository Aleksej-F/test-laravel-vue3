<template>
  
  <div class="test-button" @click.stop="testZapros">
    запрос
  </div>
</template>
<script setup>
  import { storeToRefs } from 'pinia'
  import { useUsersStore } from '../stores/Users'
  import { useFacilitiesStore } from '../stores/facilities'
  import { useSliderFacilitiyStore } from '../stores/sliderFacilitiy.js'
  const users = useFacilitiesStore()  

  async function testZapros(){
    const res = await users.getFacilitiesSlider({id:5})
  }
</script>
<style lang="scss" scoped>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
  
}
.test-button{
  margin-top: 50px;
  border: 2px solid black;
  padding: 10px;
  width: 200px;
  &:hover{
    background-color: bisque;
    cursor: pointer;
  }
}
</style>
