import { ref, computed } from "vue";
import { defineStore } from "pinia";
import axios from 'axios';

export const useMailStore = defineStore("mail", () => {
 async function sendMail(mail){
  console.log(mail)
  const data = JSON.stringify(mail)
  try {
   const config = {
     method: 'post',
     maxBodyLength: Infinity,
     url: '/api/sendmail',
     headers: { 
       'Accept': 'application/json',
       'Content-Type': 'application/json'
     },
     data: data 
   }
   await axios(config)
     .then((data)=>{
       console.log("getRegistrationUser - ", data )
       
       
       
     })
     return false
 } catch (e) {
   console.log("ошибка - ", e.response.data.error)
   commit("SET_MESSAGE_REQUEST",{
     mes:JSON.stringify(e.response.data.error[0]),
     err: true
   });
   return true
 }
 }
 
 return {
  sendMail,
 }
})