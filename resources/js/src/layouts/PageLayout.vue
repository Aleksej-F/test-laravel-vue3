<template>
  <div 
    @click.stop="message.setMenuVisible()"
  >
  
    <router-view v-slot="{ Component }">
      <transition name="fade">
        <component :is="Component" />
      </transition>
    </router-view>
  
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
  .fade-enter-from{
    transform: scaleX(0);
    opacity: 0;
  }
  
  .fade-enter-active, .fade-leave-active{
    // transform: translateX(0);
    transform-origin:right;
    transition: all 1.5s ease 2s;
  }
 .fade-leave-active{
    transform-origin:left;
  }

  .fade-enter-to, .fade-leave-from{
    
    transform:  scaleX(1);
    opacity: 1;
  }

  
  
  .fade-leave-to {
    transform: scaleX(0);
    opacity: 0;
  }
</style>