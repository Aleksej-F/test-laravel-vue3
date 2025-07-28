import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useReportsStore = defineStore('reports', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  
  const report = ref([])
  
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
  
  

    //получение данных отчета
    async function getReport({id}) {
      // const data = JSON.stringify(user)
      try {
        const config = {
          method: 'get',
          // maxBodyLength: Infinity,
          url:`/api/report/${id}`,
          headers: { 
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            Authorization: `Bearer ${user.token}`,
          },
        }
          await axios(config)
            .then(({data})=>{
              report.value = [data.data.facility]
              
            })
          return true
      } catch (e) {
        message.setMessageError( e.data )
        return false
      }
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


  return { 
    report,

    getReport,
    

  }
})
