import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'
import { useTasksStore } from './tasks.js'

export const useTaskListStore = defineStore('taskList', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  const tasks = useTasksStore() 
  
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

  const getTaskListsCompleted = computed(() => {
		const listsCompleted = taskLists.value.filter((word) => 
      word.tasks.filter((task) => task.complite).length > 0)
    return listsCompleted
	})

  function setTaskListSelectDelete(item) {
    taskListSelectDelete.value.push(... item)
  }

  function indexTaskList (id)  { 
    return taskLists.value.findIndex((element)=>{
      +element.id === +id
      })
  };
  
    //получение списков
    async function getTaskLists() {
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
         message.setMessageError( e )
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
              taskListSelect.value = data.data.taskList
              tasks.setTasks( data.data.tasks)
            })
          return true
      } catch (e) {
        message.setMessageError( e )
        return false
      }
    }

     //получение данных списка по приглашению
     async function getTaskListShare({id}) {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/tasklist/share/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            // Authorization: `Bearer ${user.token}`,
          },
        }
          await axios(config)
            .then(({data})=>{
              taskListSelect.value = data.data.taskList
              tasks.setTasks( data.data.taskList.tasks)
            })
          return true
      } catch (e) {
        
        message.setMessageError( e )
        return false
      }
    }

     //сохранение нового списка в базу
    async function setTaskListDatabase() {
      
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
              message.setMessage(data)
            })
          return true
      } catch (e) {
        message.setMessageError( e )
        return false
      }
    }

     //обновление списка в базе
     async function updateTaskListDatabase() {
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
            message.setMessage(data)
          })
        return true
      } catch (e) {
         message.setMessageError( e )
        return false
      }
    }
    // tasklist/append/{id}
    async function appendTaskListDatabase({id}) {
     
      try {
        const config = {
          method: 'post',
          // maxBodyLength: Infinity,
          url:`/api/tasklist/append/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            // "taskList": taskListSelectDelete.value
          }
        }
        await axios(config)
          .then(({data})=>{
            message.setMessage(data)
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
    }

    function settaskListSignEditing(attribute){
      taskListSignEditing.value = attribute
    }
    function clearTaskLists() {
      taskLists.value = []
    }

  return { 
    newTaskListCreate,
    taskLists,
    taskListSelect,
    taskListLength,
    viewCreateTaskListVisible,
    taskListSignEditing,
    taskListSelectDelete,
    getTaskListsCompleted,
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
    getTaskListShare,
    appendTaskListDatabase,
    clearTaskLists

  }
})
