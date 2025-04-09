<template>
 
    <TheHeader />
    <RouterView />
    <!-- <TheFooter /> -->
 
  
</template>

<script setup>
  import { RouterLink, RouterView } from 'vue-router'

  import TheHeader from '../components/TheHeader.vue';
  import TheFooter from '../components/TheFooter.vue';
</script>

<style lang="scss" scoped>
  
</style>