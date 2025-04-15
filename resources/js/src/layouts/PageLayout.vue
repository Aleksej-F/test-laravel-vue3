<template>
  <div class="wrapper"
    @click.stop="message.setMenuVisible()"
  >
  
    <router-view v-slot="{ Component }">
      <transition :name="nameTransition">
        <component :is="Component" />
      </transition>
    </router-view>
  
    <!-- <TheFooter /> -->
 </div>
  
</template>

<script setup>
  import { ref, computed } from 'vue'
  import { RouterLink, RouterView } from 'vue-router'

  import TheHeader from '../components/TheHeader.vue';
  import TheFooter from '../components/TheFooter.vue';

  import { useMessageStore } from '../stores/message.js'
  import { useRouter, useRoute } from 'vue-router'

  const message = useMessageStore()
  const route = useRoute()

  const nameTransition = computed(() => {
   return route.name == 'home' ? "home2": 'fade2'
  })
</script>

<style lang="scss" scoped>
  .wrapper{
    max-width: 1100px;
    margin: 0 auto;
  }
  .fade{
    &-enter-from{
      transform: scaleX(0);
    }
    &-enter-to{
      transform:  scaleX(1);
    }
    &-enter-active{
      transform-origin:right;
      transition: all ease 1s;
    }
    &-leave-active{
      transform-origin:right;
      transition: all  ease 1s;
    }
    &-leave-from{
      transform:  scaleX(1);
    }
    &-leave-to {
      transform: scaleX(1);
    }
  }
  .home{
    &-enter-from{
      transform:  scaleX(1);
    }
    &-enter-to{
      transform:  scaleX(1);
    }
    &-enter-active{
      position: relative;
      z-index: 1;
      transform-origin:left;
      transition: all ease 1s;
    }
    &-leave-active{
      position: relative;
      z-index: 100;
      transform-origin:right;
      transition: all  ease 1s;
    }
    &-leave-from{
      transform:  scaleX(1);
    }
    &-leave-to {
      transform:  scaleX(0);
      opacity: 0;
    }
  }

  .fade2{
    &-enter-from{
      transform: translateX(80%);
      opacity: 0;
    }
    &-enter-to{
      transform:  translateX(0);
    }
    &-enter-active{
      transform-origin:right;
      transition: all ease 1s;
    }
    &-leave-active{
      transform-origin:right;
      transition: all  ease 1s;
    }
    &-leave-from{
      transform:  scaleX(1);
    }
    &-leave-to {
      transform: scaleX(1);
    }
  }
  .home2{
    &-enter-from{
      transform:  scaleX(1);
    }
    &-enter-to{
      transform:  scaleX(1);
    }
    &-enter-active{
      position: relative;
      z-index: 1;
      transform-origin:left;
      transition: all ease 1s;
    }
    &-leave-active{
      position: relative;
      z-index: 100;
      transform-origin:right;
      transition: all  ease 1s;
    }
    &-leave-from{
      transform:  translateX(0);
    }
    &-leave-to {
      transform:  translateX(100%);
      opacity: 0;
    }
  }
</style>