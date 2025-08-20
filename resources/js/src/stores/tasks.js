import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useTasksStore = defineStore('tasks', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  
  const tasks = ref([])
  const newTaskCreate = ref({
    text: "",
    smallText: "",
    list_id: 1
  })
  const viewCreateTaskVisible = ref(false)
  const taskSelect = ref({text: ""})
  const taskSignEditing  = ref(false)
  const tasksSelectDelete = ref([])

  const tasksLength = computed(() => tasks.value.length);
  
  const tasksNoCompleted = computed(() => {
		return tasks.value.filter((word) => !word.complite)
	})

  const tasksCompleted = computed(() => {
		return tasks.value.filter((word) => word.complite)
	})

  const getTaskSelectTextLength = computed(() => {
		// console.log(taskLists.taskListSelect.text)
		return taskSelect.value.text.length
	})

  const getTaskSelectInfalidQuantity = computed(() => {
    const regex = /^\d+$/
    return !regex.test(taskSelect.value.quantity)
  })

  const getTaskSelectInfalidPrice = computed(() => {
    const regex = /^\d+$/
    return !regex.test(taskSelect.value.price)
    
  })

  const getTaskSelectSmallTextLength = computed(() => {
    // console.log(taskLists.taskListSelect.text)
    return taskSelect.value.smallText ? taskSelect.value.smallText.length : 0
  })

  function setTasksSelectDelete(item) {
    tasksSelectDelete.value.push(... item)
  }
  function setTasks(item) {
    tasks.value =  item 
  }

  function indexTaskList (id)  { 
    // return taskLists.value.findIndex((element)=>{
    //   +element.id === +id
    //   })
  };
  
    
    //получение данных задачи
    async function getTask({id}) {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/tasks/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
        }
          await axios(config)
            .then(({data})=>{
              projectsList.value = [data.data.facility]
              projectSelect.value = {... data.data.facility}
            })
          return true
      } catch (e) {
        message.setMessageError( e.data )
        return false
      }
    }

    //сохранение новой задачи в базу
    async function setTaskDatabase() {
      try {
        const config = {
          method: 'post',
          url:`/api/tasks`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            task: taskSelect.value
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

    //обновление задачи в базе
    async function updateTaskDatabase({mes }) {
      taskSelect.value.price = +taskSelect.value.price
      taskSelect.value.quantity = +taskSelect.value.quantity
      try {
        const config = {
          method: 'put',
          // maxBodyLength: Infinity,
          url:`/api/tasks/${taskSelect.value.id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            task: taskSelect.value
          }
        }
          await axios(config)
            .then(({data})=>{
              if (mes){
                message.setMessage(data)
              }
            })
          return true
      } catch (e) {
          message.setMessageError( e )
        return false
      }
    }

    //удаление задач из базы
    async function deleteTaskDatabase(id) {
     
      try {
        const config = {
          method: 'delete',
          // maxBodyLength: Infinity,
          url:`/api/tasks/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
          data: {
            "tasks": tasksSelectDelete.value
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

    //запись нулевой задачи
    async function setNewTaskCreate(id) {
      taskSelect.value = {
        text: "",
        smallText: "",
        list_id: id
      }
      taskSignEditing.value = false
    }
    
    //запись редактируемой задачи
    async function setTaskCreate(item) {
      taskSelect.value =  item
      taskSignEditing.value = true
    }

    //изменение видимости диалогового окна
    function toggleViewCreateTaskVisible(){
      viewCreateTaskVisible.value = !viewCreateTaskVisible.value
    }

    function setTaskSignEditing(attribute){
      taskSignEditing.value = attribute
    }

  return { 
    newTaskCreate,
    tasks,
    taskSelect,
    tasksLength,
    viewCreateTaskVisible,
    taskSignEditing,
    tasksSelectDelete,
    setTasksSelectDelete,
    setTaskSignEditing,
    
    indexTaskList,
    
    getTaskSelectTextLength,
    getTaskSelectSmallTextLength,
    tasksNoCompleted,
    tasksCompleted,
    getTaskSelectInfalidPrice,
    getTaskSelectInfalidQuantity,
    
    setTaskDatabase,
    updateTaskDatabase,
    deleteTaskDatabase,
    toggleViewCreateTaskVisible,
    setNewTaskCreate,
    setTaskCreate,
    setTasks

  }
})
