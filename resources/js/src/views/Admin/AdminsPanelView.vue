<template>
  <div
    
    class="text"
    @click.stop="getCatalogs"
  >
    Панель администратора 
   
  </div>
</template>
<script setup>
  
  import { useImgLoadingStore } from '../../stores/imgLoading.js'
  const imgLoadingStore = useImgLoadingStore()
  
  
  const iconsMap = {
    python: '/topics/python.svg',
    javascript: '/topics/js.svg',
    git: '/topics/git.svg',
    docker: '/topics/docker.svg',
    sql: '/topics/sql.svg',
    fastapi: '/fastapi.svg',
    django: '/django.svg',
    'vue.js': '/vuejs.svg',
  }

  async function getCatalogs(){
    console.log('jhkhjkh')
    await imgLoadingStore.getFilesListCatalog()
  }

</script>
<style lang="scss">

.flex{
  &:hover{

  }
}
.text{
  &:hover{
    cursor: pointer;
    color: aqua;
  }
}
</style>