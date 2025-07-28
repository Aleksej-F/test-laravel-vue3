<template>
   <div class="dialog-content">
        <h4>{{ headerDialog }}</h4>
        <p>Что купить:</p>
        <div class="dialogAlertField">
          <p class="alertMessageTitle" style="color: rgb(153, 153, 153);">
            {{tasks.getTaskSelectTextLength}} из 150 символов
          </p>
        </div>
        
        <textarea class="dialog-textarea" rows="4" placeholder="Начните вводить" maxlength="150"
          v-model="tasks.taskSelect.text"
        >
        </textarea>
        <div>Цена:</div>
        <input type="text" v-model="tasks.taskSelect.price">
        <div>Колличество:</div>
        <input type="text" v-model="tasks.taskSelect.quantity">
        <div>Кто покупает:</div>
        <select  v-model="tasks.taskSelect.executor_user_id">
          <option v-for="option in taskLists.taskListSelect.usersList" :value="option.id">
            {{ option.name }}
          </option>
        </select>
		    <p>Комментарий:</p>
        <div class="dialogAlertField">
          <p class="alertMessageTitle" style="color: rgb(153, 153, 153);">
            {{tasks.getTaskSelectSmallTextLength}} из 150 символов
          </p>
        </div>
        
        <textarea class="dialog-textarea" rows="4" placeholder="Комментарий" maxlength="150"
          v-model="tasks.taskSelect.smallText"
        >
          
        </textarea>
      </div>
</template>

<script setup>
    import { ref, computed, watch } from "vue";
    import { useRouter, useRoute } from "vue-router";

    import { useTasksStore } from '../../stores/tasks.js'
    import { useTaskListStore } from '../../stores/taskList.js'
    const taskLists = useTaskListStore() 
    const tasks = useTasksStore() 
    
    const headerDialog = computed(() => {
   //  console.log(props.item.tasks.length);
        return tasks.taskSignEditing ?	"Редактирование задачи:" : "Новая  задача:";
    });
   
       console.log(taskLists.taskListSelect);



</script>

<style lang="scss" scoped>

</style>
