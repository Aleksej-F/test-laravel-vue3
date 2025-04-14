<template>
   <div class="dialog-content">
        <h4>{{ headerDialog }}</h4>
        <div class="dialogAlertField">
          <p class="alertMessageTitle" style="color: rgb(153, 153, 153);">
            {{tasks.getTaskSelectTextLength}} из 150 символов
          </p>
        </div>
        <textarea class="dialog-textarea" rows="4" placeholder="Начните вводить" maxlength="150"
          v-model="tasks.taskSelect.text"
        >
          
        </textarea>
		  <div class="dialogAlertField">
          <p class="alertMessageTitle" style="color: rgb(153, 153, 153);">
            {{tasks.getTaskSelectSmallTextLength}} из 150 символов
          </p>
        </div>
        <textarea class="dialog-textarea" rows="4" placeholder="Коментарий" maxlength="150"
          v-model="tasks.taskSelect.smallText"
        >
          
        </textarea>
      </div>
</template>

<script setup>
    import { ref, computed, watch } from "vue";
    import { useRouter, useRoute } from "vue-router";

    import { useTasksStore } from '../../stores/tasks.js'
    const tasks = useTasksStore() 
    
    const headerDialog = computed(() => {
   //  console.log(props.item.tasks.length);
        return tasks.taskSignEditing ?	"Редактирование задачи:" : "Новая  задача:";
    });
   




</script>

<style lang="scss" scoped>

</style>
