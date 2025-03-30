<template>
    
  <div class="app-main-layout" >
    <TheHeader />
    <Sidebar  v-model="isOpen"/>
    <main class="app-content" >
      <div class="app-page">
        <RouterView/>
      </div>
    </main>
  </div>
</template>
<script setup>
  import { ref, computed } from 'vue'
  import { RouterView } from 'vue-router'
  import TheHeader from '../components/TheHeader.vue';
  import Sidebar from '../components/Admin/Sidebar.vue'
  // import Sidebar from '../components/Admin/Sidebar.vue';
  const isOpen = ref(true) 
  
    
   
</script>
<style lang="scss">
.app{
  &-page{
    padding: 10px;
    overflow: auto ;
    z-index: 15;
  };
  &-content{
    
    padding-left:250px;
    transition:padding-left .3s;
    position:relative;
    
    @media (max-width: 768px) {
      padding-left:35px;
    }
  };
  &-main-layout{
    position:relative;
    height:100vh;
    overflow: auto  ;
  };

}

</style>