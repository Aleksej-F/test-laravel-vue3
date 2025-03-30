import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useFacilitiesStore = defineStore('facilities', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  const newProjectCreate = ref({
    title: "",
    h2: "",
    urlImg: "",
    
    titleSlider: "",
    address: "",
    workPeriod: "",
    materials: ``,
    sliders: []
  })
  // {
  //   description: "",
  //   facility_id: 0,
  //   id: 0,
  //   img: "",
  //   num: "1",
  //   title:  "0"}

  const projectsList = ref([])
  const projectSelect = ref({})
  const projectsListLength = computed(() => projectsList.value.length);
  const projectSlider = computed(() => projectSelect.value.sliders);
  function indexProject (id)  { 
    return projectsList.value.findIndex((element)=>{
      +element.id === +id
      })
  };
  
    //получение объектов
    async function getFacilities() {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:'/api/v1/facility',
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
        }
          await axios(config)
            .then(({data})=>{
              projectsList.value = data.data.facilities
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }
    //получение объекта со слайдером
    async function getFacilitiesSlider({id}) {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/v1/facility/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
          },
        }
          await axios(config)
            .then(({data})=>{
              console.log(data.data.facility)
              projectsList.value = [data.data.facility]
              projectSelect.value = {... data.data.facility}
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }

     //сохранение объекта в базу
    async function setFacilityDatabase() {
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'post',
          // maxBodyLength: Infinity,
          url:`/api/v1/facility`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            facility: projectSelect.value
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
         message.setMessageError( e )
        return false
      }
    }

     //обновление объекта в базе
     async function updateFacilityDatabase() {
      console.log('user.token')
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'put',
          // maxBodyLength: Infinity,
          url:`/api/v1/facility/${projectSelect.value.id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            facility: projectSelect.value
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
         message.setMessageError( e )
        return false
      }
    }

    //удаление объекта из базы
    async function deleteFacilityDatabase(id) {
      console.log('user.token')
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'delete',
          // maxBodyLength: Infinity,
          url:`/api/v1/facility/${id}`,
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
         message.setMessageError( e )
        return false
      }
    }

     //запись нулевого объекта
    async function setNewFacilitiesCreate() {
      projectsList.value = [newProjectCreate.value]
      projectSelect.value = {... newProjectCreate.value}
    }
    function clickToProjectSelectDeleteVideo(){
      projectSelect.value.urlVideo = ""
    }
     

  return { 
    newProjectCreate,
    projectsList, 
    projectsListLength, 
    projectSelect,
    projectSlider,
    indexProject,
    getFacilities,
    getFacilitiesSlider,
    setNewFacilitiesCreate,
    setFacilityDatabase,
    updateFacilityDatabase,
    deleteFacilityDatabase,
    clickToProjectSelectDeleteVideo
  }
})
