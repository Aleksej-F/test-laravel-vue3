<template>
  <div class="projects-cont-item" date_num="1" >
    <img 
      :src="'/storage/img/'+item.urlImg" 
      alt=""
      v-if="item.urlImg"
    >
    <!-- :to="{ name: 'project', params: { id: item.id } }" -->
      <div class="projects-cont-item__description"
        @click.stop="toProject(item.id)"
      
      >
        <div class="projects-cont-item__edit-block"
          v-if="route.meta.autch"
        >
          <div class="projects-cont-item__edit"
            title="Редактировать"
            @click.stop="toEditProject(item.id)"
          >
            <svg width="32" height="32" fill="currentColor"  viewBox="0 0 16 16">
              <path fill="#269EB7" d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill="#269EB7"  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
          </div>
          <div  class="projects-cont-item__edit"
            title="Удалить объект"
            @click.stop="projectClickToDelete(item.id)"
          >
            <svg  width="30" height="30" fill="#269EB7"  viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
            </svg>
          </div>
        </div>
        <h2> 
          {{ item.title }}
        </h2>
        <p>
          {{ item.h2 }}
        </p>
      </div>
  </div>
</template>

<script setup>
  import { useRouter, useRoute } from 'vue-router'
  import { useFacilitiesStore } from '../../stores/facilities.js'

  const route = useRoute()
  const router = useRouter()
  const projects = useFacilitiesStore()
  const props = defineProps(['item', 'index'])
  
  console.log(route.meta.autch)

  function toEditProject(itemId) {
    router.push({ name: 'adminsFacilitiesCreate',  params: { id: itemId, operation:'edit' }})
  }

  function toProject(itemId){
    if (route.meta.autch) {
      router.push({ name: 'adminsFacilityDescriptionCreate', params: { id: itemId, operation:'edit' } })
    } else{
      router.push({ name: 'project', params: { id: itemId } })
    }
    
    
  }

  async function projectClickToDelete(id){
    await projects.deleteFacilityDatabase(id)
    await projects.getFacilities()
  }
</script>

<style lang="scss" scoped>
 .projects-cont-item{
    width: 455px;
    height: 464px;
    position: relative;
    background-color: #bebdbd;
    @media  (max-width: 480px) { 
      width: 80vw;
      height: 40vh;
    }
    & img{
      width: 100%;
      height: 100%;
    }
    &__shield{
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
    }
    &__description{
      position: absolute;
      top: 0;
      width: 100%;
      height: 100%;
      background-color:  rgb(251 251 251 / 70%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      display: none;
      text-decoration: none;
      & h2{
        font-size: 30px;
        font-weight: 600;
        text-align: center;
        color: #0e0d0d;
      }
      & p {
        margin-top: 10px;
        font-size: 20px;
        color: #575656;
      }
    }
    &:hover{
      &>div{
        display: flex;
        cursor: pointer;
      }
    }
    &__edit{
      
      padding: 10px;
      color: rgb(18, 39, 230);
      transition: all 0.1s ease-out;
      &-block{
        position: absolute;
        top: 0;
        right: 0;
      }
      &:hover{
        color: rgb(235, 24, 42);
        transform: scale(1.15);
       
      }
    }
  }
</style>