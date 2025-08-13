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
        <div class="text-field__cont">
          <input  
            class="text-field__input" 
            :class="{invalid: tasks.getTaskSelectInfalidPrice}" 
            type="text" 
            v-model="tasks.taskSelect.price"
            pattern="^\d+$"
            data-error-message="Для ввода разрешены цифры"
          >
          <p class="message-infalid"
            v-if="tasks.getTaskSelectInfalidPrice"
          >Для ввода разрешены цифры</p>
        </div>
        <div>Колличество:</div>
        <div class="text-field__cont">
          <input 
            class="text-field__input" 
            :class="{invalid: tasks.getTaskSelectInfalidQuantity}" 
            v-model="tasks.taskSelect.quantity"
            pattern="^\d+$"

            data-error-message="Для ввода разрешены цифры"
          >
          <p class="message-infalid"
            v-if="tasks.getTaskSelectInfalidQuantity"
          >Для ввода разрешены цифры</p>
        </div>
        <div>Кто покупает:</div>
        <select  class="text-field__select" v-model="tasks.taskSelect.executor_user_id">
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

   


</script>

<style lang="scss" scoped>
  .text-field__input,
  .text-field__select {
    width: 100%;
    display: block;
    height: 25px;
    margin-bottom: 5px;
    padding: 1px 0.75rem;
    
    font-weight: 400;
    font-size: 16px;
    line-height: 24px;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid var(--color-secondary);
    border-radius: var(--radius);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    @media (max-width: 350px){
      height: 36px;
      padding: 2px;
    }
  }
  .invalid{
    border-color: #d31d1d;
  }
  .text-field__cont{
    height: 50px;
  }
  .message-infalid{
    margin: 0;
    padding-left: 20px;
    color: #d31d1d;
    font-size: 13px;
  }
</style>
