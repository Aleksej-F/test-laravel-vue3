import { ref, computed } from 'vue'
import { defineStore, storeToRefs  } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useFacilitiesStore } from './facilities.js'
import { useUsersStore } from './Users.js'

export const useSliderFacilitiyStore = defineStore('sliderFacilitiy', () => {
  const message = useMessageStore()
  const facilities = useFacilitiesStore()
  const user = useUsersStore()
  const {indexProject} = storeToRefs(facilities)
  const itemSlideSelect = ref({})
  
    //получение слайдера объекта
    async function getSliderFacilitiy({id}) {
      // const data = JSON.stringify(user)
      
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/v1/slider/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
         
          },
         
        }
          await axios(config)
            .then(({data})=>{
              console.log("getFacilities - ", data.data.slider )
              console.log("getFacilities - ", facilities.projectsList)
              console.log("getFacilities - ", facilities.indexProject(id))
              if (facilities.indexProject(1) >= 0){
                facilities.projectsList.value[facilities.indexProject(id)].slider = data.data.slider
              }
              
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }

     //создание слайда в базе
     async function createSlideDatabase(slide) {
      console.log(slide)
      
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'post',
          // maxBodyLength: Infinity,
          url:`/api/v1/slider`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            slide: slide
          }
        }
          await axios(config)
            .then(({data})=>{
              console.log(data)
              message.setMessage(data)
              console.log(facilities.projectSelect.sliders)
              facilities.projectSelect.sliders.push(data.data.slideNew)
              // projectsList.value = [data.data.facility]
              itemSlideSelect.value = {... data.data.slideNew}
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }

     //обновление слайда в базе
     async function updateSlideDatabase() {
      console.log('user.token')
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'put',
          // maxBodyLength: Infinity,
          url:`/api/v1/slider/${itemSlideSelect.value.id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            slide: itemSlideSelect.value
          }
        }
          await axios(config)
            .then(({data})=>{
              console.log(data)
              message.setMessage(data)
              // projectsList.value = [data.data.facility]
              // projectSelect.value = {... data.data.facility}
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }

     //удаление слайда из базы
     async function deleteSlideDatabase(id) {
      console.log('user.token')
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'delete',
          // maxBodyLength: Infinity,
          url:`/api/v1/slider/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          
        }
          await axios(config)
            .then(({data})=>{
              console.log(data)
              message.setMessage(data)
              // projectsList.value = [data.data.facility]
              // projectSelect.value = {... data.data.facility}
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }


  return { 
    itemSlideSelect,
    createSlideDatabase,
    getSliderFacilitiy,
    updateSlideDatabase,
    deleteSlideDatabase,
  }
})
