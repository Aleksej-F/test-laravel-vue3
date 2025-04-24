import { defineStore } from 'pinia'
import { ref, computed } from "vue";
import axios from 'axios';
import { useConfigStore } from './Config.js'
import { useMessageStore } from './message.js'

export const useUsersStore = defineStore('users', () => {
  const message = useMessageStore()
  
  const url = useConfigStore().url 
  
  
  const token = ref(localStorage.getItem('token') ?
  localStorage.getItem('token') : null)
  const pageName = ref(localStorage.getItem('pageLink') ?
  localStorage.getItem('pageLink') : "/")

  
 
  const autchUser = computed(() => token.value !== null)

  function setToken(token) {
    console.log('setIsLoaderStatus - ', token)
    token.value = token
  }
   
  //регистрация на сайте
  async function setRegistrationUser(user) {
    const data = JSON.stringify(user)
    
    try {
      const config = {
        method: 'post',
        maxBodyLength: Infinity,
        url:'/api/v1/register',
        headers: { 
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        data: data 
      }
      const reg = await axios.get('/sanctum/csrf-cookie')
        .then(response =>{
          console.log(response)
          const res = axios(config)
          .then((response)=>{
            token.value = response.data.data.token
            localStorage.setItem('token', response.data.data.token);
            return true  
          })
          .catch( ({response})=> {
            message.setMessageError( response.data )
            return false
          })
          
          return res
      })
      
      return reg   
    } catch (e) {
      
      return false
    }
  }
  
  //авторизация на сайте
  async function setLogInUser(user) {
    const data = JSON.stringify(user)
    
    try {
      const config = {
        method: 'post',
        maxBodyLength: Infinity,
        url:'/api/v1/login',
        headers: { 
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        data: data 
      }
      const reg = await axios.get('/sanctum/csrf-cookie')
        .then(response =>{
          const res = axios(config)
          .then((response)=>{
            console.log("getloginUser - ", response )
            token.value = response.data.data.token
            localStorage.setItem('token', response.data.data.token);
            return true
          })
          .catch( ({response})=> {
            console.log("getloginUser  err - ", response.data )
            message.setMessageError( response.data )
            return false
          })
          return res
      })
      return reg
    } catch (e) {
      console.log("getRegistrationUser - ", e )
      message.setMessageError( e )
      return false
    }
  }
   //выход с админки
   async function setLogout() {
    // const data = JSON.stringify(user)
    
    try {
      const config = {
        method: 'post',
        // maxBodyLength: Infinity,
        url:'/api/v1/logout',
        headers: { 
        //   'Accept': 'application/json',
          'Content-Type': 'application/json',
        Authorization: `Bearer ${token.value}`,
        },
        // data: data 
      }
      // const reg = await axios.get('/sanctum/csrf-cookie')
      //   .then(response =>{
          await axios(config)
          .then((response)=>{
            token.value = null
            localStorage.removeItem('token');
          })
          
          
          return true
      // })
      
      // return reg   
    } catch (e) {
       message.setMessageError( e.data )
      return false
    }
  }
   //авторизация на сайте через бота тг
   async function setLogInBotTgUser(user) {
    const data = JSON.stringify(user)
    
    try {
      const config = {
        method: 'post',
        maxBodyLength: Infinity,
        url:'/api/v1/loginbottg',
        headers: { 
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        data: data 
      }
      const reg = await axios.get('/sanctum/csrf-cookie')
        .then(response =>{
          const res = axios(config)
          .then((response)=>{
            console.log("getloginUser - ", response )
            token.value = response.data.data.token
            localStorage.setItem('token', response.data.data.token);
            return true
          })
          .catch( ({response})=> {
            console.log("getloginUser  err - ", response.data )
            message.setMessageError( response.data )
            return false
          })
          return res
      })
      return reg
    } catch (e) {
      console.log("getRegistrationUser - ", e )
      message.setMessageError( e.data )
      return false
    }
  }
  
   //тестирование запросов
   async function setTestZapros(test) {
    const data = JSON.stringify(test)
    
    try {
      const config = {
        method: 'get',
        
        url:'api/greeting',
        headers: { 
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        // data: data 
      }

      const reg = await axios.get('/sanctum/csrf-cookie')
        .then(response =>{
          const res = axios(config)
          .then((data)=>{
            console.log("getloginUser - ", data )
            
            return true
          })
          .catch( ({response})=> {
            console.log("getloginUser  err - ", response)
           
            return false
          })
          return res
      })
      return reg
          
          
        
      
      
    } catch (e) {
      
      return false
    }
  }
  return {
    autchUser,
    token,
    pageName,
    
    setToken,
    setRegistrationUser,
    setLogInUser,
    setLogout,
    setLogInBotTgUser,
    
    setTestZapros
  }
})