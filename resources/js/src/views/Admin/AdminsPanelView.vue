<template>
  <div
    
    class="text"
    @click.stop="getCatalogs"
  >
    Панель администратора {{  iconsMap['vue.js']}}
    <img
      src="../../assets//img/logo.png"
      width="20"
      alt=""
    />
  </div>
</template>
<script setup>
  import TheHomeProjects from '../../components/TheHomeProjects.vue';
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