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
    // tasks: []
  })
  const viewCreateTaskListVisible = ref(false)
  const taskListSelect = ref({text: ""})
  const taskListSignEditing  = ref(false)
  const taskListLength = computed(() => taskLists.value.length);
  const taskListSelectDelete = ref([])

  function setTaskListSelectDelete(item) {
    taskListSelectDelete.value.push(... item)
    console.log(taskListSelectDelete.value)
  }

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

     //сохранение нового списка в базу
    async function setTaskListDatabase() {
      console.log(user.token)
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'post',
          url:`/api/tasklist`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            taskList: taskListSelect.value
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

     //обновление списка в базе
     async function updateTaskListDatabase() {
      console.log(taskListSelect.value)
      try {
        const config = {
          method: 'put',
          // maxBodyLength: Infinity,
          url:`/api/tasklist/${taskListSelect.value.id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            taskList: taskListSelect.value
          }
        }
          await axios(config)
            .then(({data})=>{
              console.log(data)
              message.setMessage(data)
              
            })
          return true
      } catch (e) {
         message.setMessageError( e )
        return false
      }
    }

    //удаление списка из базы
    async function deleteTaskListDatabase(id) {
     
      try {
        const config = {
          method: 'delete',
          // maxBodyLength: Infinity,
          url:`/api/tasklist/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            "taskList": taskListSelectDelete.value
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

     //запись нулевого списка
    async function setNewTaskListCreate() {
      // projectsList.value = [newTaskListCreate.value]
      taskListSelect.value = {... newTaskListCreate.value}
      taskListSignEditing.value = false
    }
    
     //запись редактируемого списка
     async function setTaskListCreate(item) {
      // projectsList.value = [newTaskListCreate.value]
      taskListSelect.value = {... item}
      taskListSignEditing.value = true
    }
     //изменение видимости диалогового окна
    function toggleViewCreateTaskListVisible(){
      if (viewCreateTaskListVisible.value) {
        setNewTaskListCreate() // обнуление при закрытии
      }
      viewCreateTaskListVisible.value = !viewCreateTaskListVisible.value
      console.log(viewCreateTaskListVisible.value)
    }

    function settaskListSignEditing(attribute){
      taskListSignEditing.value = attribute
    }

  return { 
    newTaskListCreate,
    taskLists,
    taskListSelect,
    taskListLength,
    viewCreateTaskListVisible,
    taskListSignEditing,
    taskListSelectDelete,
    setTaskListSelectDelete,
    settaskListSignEditing,
    indexTaskList,
    getTaskLists,
    getTaskList,
    updateTaskListDatabase,
    deleteTaskListDatabase,
    toggleViewCreateTaskListVisible,
    setNewTaskListCreate,
    setTaskListCreate,
    setTaskListDatabase,

  }
})
