<template>
  <!-- <pagelayout /> -->
  <component :is="layout" />
</template>

<script setup>
  import { ref, computed } from 'vue'
  import { useRoute, RouterLink, RouterView } from 'vue-router'
  
  import EmptyLayout from './src/layouts/EmptyLayout.vue'
  import PageLayout from './src/layouts/PageLayout.vue'
  import AdminLayout from './src/layouts/AdminLayout.vue'
  
  const route = useRoute()
  const layoutComponent = ref( {
    EmptyLayout, PageLayout, AdminLayout
  })
  
  const layout = computed(() => {
    return layoutComponent.value[(route.meta.loyout || 'Page') + 'Layout']}
  )
 

</script>

<style scoped>

</style>
