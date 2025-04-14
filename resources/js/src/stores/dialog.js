import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { useConfigStore } from './Config.js'

export const useDialogStore = defineStore('dialog', () => {
  
  
  const visible = ref(false)
  const layout = ref('')
  const buttonClick = ref(null)
  const dialogeDelete = ref(false)

  //изменение видимости диалогового окна
  function setLayout(lay){
    layout.value = lay
    console.log(layout.value)
  }

  function toggleViewDialogVisible(){
    visible.value = !visible.value
    console.log(visible.value)
  }
  
  
  function setButtonClick(param){
    buttonClick.value = param
    console.log(buttonClick.value)
    setTimeout(() => buttonClick.value = null, 1000)
  }

  async function setDialogeDelete(param){
    dialogeDelete.value = param
    // console.log(dialogeDelete.value)
    let promise = new Promise((resolve, reject) => {
      let timerId = setInterval(() => {
        if (buttonClick.value !== null){
          resolve(buttonClick.value.ok)
          clearTimeout(timerId)
        }
      }, 200);
    });
    let result = await promise
    
    return result
  }
  
  return { 
    layout,
    visible, 
    buttonClick,
    dialogeDelete,
    toggleViewDialogVisible,
    setLayout,
    setButtonClick,
    setDialogeDelete
  }
})
