<template>
  <MessageView/>
  <MyLoader/>
  <!-- <MyConfirm/> -->
  <div class="backgraund">
    <RouterView />
  </div>
</template>
<script setup>
  import { RouterLink, RouterView } from 'vue-router'
  import MessageView from "../components/ui/MessageView.vue"
  import MyLoader from '../components/ui/LoaderView.vue'
  // import MyConfirm from '../components/ui/MyConfirm.vue'
  
</script>
<style lang="scss" scoped>
.backgraund{
  width: 100%;
  height: 100%;
  min-height: 100vh;
  background-color: #f0eeff;
  padding-top: 1px;
  
}
</style>