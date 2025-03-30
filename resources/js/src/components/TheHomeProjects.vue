<template>
  <section class="projects">
      <a name="projects"></a>
      <div class="wrap2 projects-title">
        <span  class="info-title">Реализованные проекты</span>
      </div>
      <div class="wrap2">
        <div class="projects-cont">
          <TheItemProjects 
            v-for="(item, index ) in listProjects" 
            :key="+item.id"
            :item="item"
          />
        </div>
        <div class="projects-cont__show" 
          v-if="showVisible"
        >
          <p @click.stop="addProjects">
            ПОКАЗАТЬ ЕЩЕ
          </p>
        </div>
      </div>
    </section>
 </template>

 <script setup>
 import { onMounted } from 'vue'
  import { ref, computed } from 'vue'
  import { useProjectsStore } from '../stores/projects.js'
  import { useFacilitiesStore } from '../stores/facilities.js'
  import TheItemProjects from './items/TheItemProjects.vue'

  // const projects = useProjectsStore()  
  const projects = useFacilitiesStore()
  
  const limit = ref(4)

  

  const listProjects = computed(() => {
    return projects.projectsListLength > 0 ?
    projects.projectsList.slice(0, limit.value):[] 
  })
  
  const showVisible = computed(()=> {
    return listProjects.value.length < projects.projectsListLength ? true : false
  })
  
  function addProjects() {
    if (limit.value + 4 < projects.projectsListLength) {
      limit.value += 4 
    } else limit.value = projects.projectsListLength
  }

  onMounted(async() => {
    await projects.getFacilities()
  })

  projects.getFacilities()
  
</script>

<style lang="scss" scoped>
.projects{
  &-title{
    margin-top: 60px;
  }
  &-cont{
    display: flex;
    flex-wrap: wrap;
    row-gap: 30px;
    column-gap: 30px;
    margin-top: 60px;
    justify-content: center;
    margin-bottom: 60px;
    &__show{
      margin-top: 60px;
      margin-bottom:60px;
      display: flex;
      justify-content: center;
      & p{
        cursor: pointer;
        font-size: 25px;
        color:  #727171;
        border: 1px solid #727171;
        padding: 5px 30px;
        &:hover{
          color:  #edcd1f;
        border: 1px solid #edcd1f;
        }
      }
    }
  }
}
</style>