<template>
  <div>
    <div class="button-cont">
      <div class="button"
        title="Добавить новый объект"
        @click.stop="createFacility"
      >
        <svg width="36" height="37" viewBox="0 0 36 37" fill="none" >
          <path fill-rule="evenodd" clip-rule="evenodd" d="M30.4023 18.8252C30.4023 25.9054 24.6627 31.645 17.5825 31.645C10.5023 31.645 4.7627 25.9054 4.7627 18.8252C4.7627 11.745 10.5023 6.00537 17.5825 6.00537C24.6627 6.00537 30.4023 11.745 30.4023 18.8252ZM31.9023 18.8252C31.9023 26.7338 25.4911 33.145 17.5825 33.145C9.6739 33.145 3.2627 26.7338 3.2627 18.8252C3.2627 10.9166 9.6739 4.50537 17.5825 4.50537C25.4911 4.50537 31.9023 10.9166 31.9023 18.8252ZM24.7419 19.899H10.4221V17.751H24.7419V19.899Z" fill="#269EB7"/>
          <path d="M16.5088 11.6646L16.5088 25.9844L18.6567 25.9844L18.6567 11.6646L16.5088 11.6646Z" fill="#269EB7"/>
        </svg>
      </div>
    </div>
    <TheHomeProjects />
  </div>
</template>
<script setup>
  import TheHomeProjects from '../../components/TheHomeProjects.vue';
  import { useRouter, useRoute } from 'vue-router'
  
  const router = useRouter()
  const route = useRoute()
  
  function createFacility(){
    router.push({name: 'adminsFacilitiesCreate', params: {operation:"create", id: 0  } })
  }
</script>
<style lang="scss">
  .button{
    margin-right: 20px;
    &-cont{
      position: fixed;
      right: 90px;
      top: 175px;
      display: flex;
      justify-content: end;
      z-index: 20;
      @media  (max-width: 480px) { 
        right: 30px;
      }
    }
    
    transition: all 0.1s ease-out;
    &:hover{
      cursor: pointer;
      transform: scale(1.15);
    }
  }
</style>