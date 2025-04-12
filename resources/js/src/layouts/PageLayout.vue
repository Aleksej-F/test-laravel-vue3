<template>
  <div 
    @click.stop="message.setMenuVisible()"
  >
    <TheHeader @click.stop="message.setMenuVisible()"/>
    <RouterView />
    <!-- <TheFooter /> -->
 </div>
  
</template>

<script setup>
  import { RouterLink, RouterView } from 'vue-router'

  import TheHeader from '../components/TheHeader.vue';
  import TheFooter from '../components/TheFooter.vue';


  import { useMessageStore } from '../stores/message.js'
  const message = useMessageStore()
</script>

<style lang="scss" scoped>
  
</style>