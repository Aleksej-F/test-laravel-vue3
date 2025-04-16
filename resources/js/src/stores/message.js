import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { useConfigStore } from './Config.js'

export const useMessageStore = defineStore('message', () => {
  const url = useConfigStore().url 
  
  const message = ref(false)
  const error = ref("")
  const displayed = ref(false)
  const menuVisible = ref(false)
  

  const doubleCount = computed(() => count.value * 2)
  
  function setMessage(data) {
    let mes = ''
    if (data.errors) {
      mes = {
        err: true, 
        mes: `${data.message}!<hr>  ${data.error[0] ? data.error[0]:''}`
      }
    } else {
      mes = {
        err: false, 
        mes: data.message
      }
    }
    message.value = mes
    setIntevalTime ()
  }

  function setMessageError( e ) {
    console.log(e)
    let mes = e.message ? `${e.message} <hr>` : ''
    
    if (e.response.data && e.response.data.message) {
      mes += `${e.response.data.message}!<hr>`
    }

    if (e.error) {
      mes += `${e.error}<hr>`
    }

    // if (e.data.data) {
    //   message += `${e.data.data.message || ''}<hr>`
    // }/share/32

    message.value = {err:true, mes: mes}
    setIntevalTime ()
    
  }

  function setIntevalTime (){
    let start = new Date()
    let timerId = setInterval(() => {
      if ( !message.value ) {
        clearInterval(timerId)
      }
      let end = new Date()
      if ((end - start) > 3000) {
        message.value = false
      }
    }, 200);
  }
  function setMessageVisibleFalse(){
    message.value = null
  }

  function setMenuVisible(params) {
    menuVisible.value = true
    setTimeout(() => menuVisible.value = false, 1000);
  }
  return { 
    url, 
    message, 
   
    error,
    displayed,
    menuVisible,
    setMessage,
    setMessageVisibleFalse,
    setMessageError,
    setMenuVisible
  }
})
