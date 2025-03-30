import { defineStore } from 'pinia'
import { ref, computed } from "vue";

export const useLoaderStore = defineStore('loader', () => {
  const isLoader = ref(false)
  
  const  getIterations = computed(() => state.isLoader)
 
  function setIsLoaderStatus(status) {
    console.log('setIsLoaderStatus - ', status)
    isLoader.value = status
  }
    
  return {
    isLoader,
    getIterations,
    setIsLoaderStatus,

  }
})