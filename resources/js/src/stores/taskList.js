import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useTaskListStore = defineStore('taskList', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  
  const taskLists = ref([])
  const newTaskListCreate = ref({
    text: "",
    tasks: []
  })
  const viewCreateTaskListVisible = ref(false)
  const taskListSelect = ref({text: ""})
  const taskListLength = computed(() => taskLists.value.length);
  

  function indexTaskList (id)  { 
    return taskLists.value.findIndex((element)=>{
      +element.id === +id
      })
  };
  
    //получение списков
    async function getTaskLists() {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:'/api/tasklist',
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
        }
          await axios(config)
            .then(({data})=>{
              taskLists.value = data.data.taskLists
            })
          return true
      } catch (e) {
         message.setMessageError( e.data )
        return false
      }
    }
    //получение данных списка
    async function getTaskList({id}) {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/tasklist/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
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
    async function setNewTaskListCreate() {
      // projectsList.value = [newTaskListCreate.value]
      taskListSelect.value = {... newTaskListCreate.value}
    }
    
     
    function toggleViewCreateTaskListVisible(){
      console.log('dfgdfg')
      viewCreateTaskListVisible.value = !viewCreateTaskListVisible.value
      console.log(viewCreateTaskListVisible.value)
    }

  return { 
    newTaskListCreate,
    taskLists,
    taskListSelect,
    taskListLength,
    viewCreateTaskListVisible,
    indexTaskList,
    getTaskLists,
    getTaskList,
    toggleViewCreateTaskListVisible,
    setNewTaskListCreate
  }
})
