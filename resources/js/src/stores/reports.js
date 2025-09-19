import { ref, computed } from 'vue'
import { defineStore, storeToRefs } from 'pinia'
import axios from 'axios';
import { useMessageStore } from './message.js'
import { useUsersStore } from './Users.js'

export const useReportsStore = defineStore('reports', () => {
  const message = useMessageStore()
  const user = useUsersStore()
  
  const report = ref([])
  const showDetails = ref(false)


 

  const reportlength = computed(() => report.value.length);
  
  
  const averageExpense = computed(() => {
    let sum = 0
		report.value.forEach((user) => {
      user.tasks.forEach((element) => {
        if (element.complite) {
          sum += element.quantity * element.price
        }
        
      })
    })
    
    return sum/report.value.length
	})
  
  const expenses = computed(() => {
		let sum = 0
		report.value.forEach((user) => {
      user.tasks.forEach((element) => {
        if (element.complite) {
          sum += element.quantity * element.price
        }
      })
    })
    const average = sum/report.value.length
    return {average,sum}
	})

  const showDetailsText = computed(() => {
		return showDetails.value ? 'Скрыть':'Показать'
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
              console.log(data.data.usersList)
              report.value = data.data.usersList
              
            })
          return true
      } catch (e) {
        message.setMessageError( e.data )
        return false
      }
    }

  
    
    
    //показать скрыть подробности элементов отчета
    function toggleShowDetails(){
      showDetails.value = !showDetails.value
    }

    

  return { 
    report,
    showDetails,
    expenses,

    reportlength,
    averageExpense,
    
    showDetailsText,

    getReport,
    toggleShowDetails,

  }
})
