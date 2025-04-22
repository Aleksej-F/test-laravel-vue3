<template>
   <div class="dialog-content">
        <h4>данные пользователя{{  user }}</h4>
        
      </div>
</template>

<script setup>
   import { ref, computed, shallowRef } from 'vue'
   const user= ref( localStorage.getItem('user'))
</script>

<style lang="scss" scoped>
   .dialog-content{
      text-align: center;
    }
</style>
