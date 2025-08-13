<template>
    <div>
        <div id="tasksScreen" class="screens active">
            <!-- @click.stop="setNoVisibleMenu()" -->
            <div class="wrap">
                <div class="sortMenuOut"></div>
                <div id="tasksListOut" class="light">
                    <div class="list-group" 
                      v-if="reports.reportlength > 0"
                      >
                        <TheItemReport
                            v-for="(item, index) in reports.report"
                            :key="+item.id"
                            :itemReports="item"
                            :menuVisible="menuVisible"
                            :displayDetails="reports.showDetails"
                        />
                    </div>
                    <div class="list-group" v-else>
                        <p>
                            {{ tesxNoTasks }}
                        </p>
                    </div>
                

                  <!-- <div class="compliteTaskPanelHeader"
                    v-if="tasks.tasksCompleted.length > 0"
                    @click.stop="toogleTaskComplitedVisible"
                  >
                    <div id="toggle-button">
                        <img
                            src="../assets/img/icons/angle-right-gray.svg"
                            :class="{ open: taskComplitedVisible }"
                        />
                    </div>
                    <span>завершено {{ tasks.tasksCompleted.length }}</span>
                  </div>
                  <div id="panel" 
                    :class="{open: !taskComplitedVisible }"

                  >
                    <TheItemTask
                      v-for="(item, index) in tasks.tasksCompleted"
                      :key="+item.id"
                      :item="item"
                      :menuVisible="menuVisible"
                    />
                  </div> -->
                </div>
               
            </div>
        </div>
    </div>
</template>

<script setup>
  import { useRouter, useRoute } from 'vue-router'
  import { onMounted } from "vue";
  import { ref, computed } from "vue";
  import { useTaskListStore } from "../stores/taskList.js";
  import { useUsersStore } from "../stores/Users.js";
  import { useTasksStore } from '../stores/tasks.js'
  import { useDialogStore } from "../stores/dialog.js";
  import { useReportsStore } from "../stores/reports.js";

  import TheItemTask from "./items/TheItemTask.vue";
  import TheItemReport from "./items/TheItemReport.vue"

  const route = useRoute()

  const taskLists = useTaskListStore();
  const user = useUsersStore();
  const tasks = useTasksStore() 
  const dialog = useDialogStore() 
  const reports = useReportsStore();

  const tesxNoTasks = computed(() => {
      if (user.autchUser) {
          return "В этом списке нет задач. Создайте их.";
      } else {
          return "Для просмотра отчета авторизуйтесь.";
      }
  });

  const taskComplitedVisible = ref(false);
  const menuVisible = ref(false);
  const taskListId = ref(route.params.id);
  
  onMounted(async () => {
      console.log(reports.report)
      if (user.autchUser) {
        await taskLists.getTaskList({id:route.params.id});
        await reports.getReport({id:route.params.id});
        
      }
  });
  function toogleTaskComplitedVisible() {
    taskComplitedVisible.value = !taskComplitedVisible.value
  }
  function setNoVisibleMenu() {
      // console.log('menuVisible.value - ', menuVisible.value)
      menuVisible.value = true;
      setTimeout(() => (menuVisible.value = false), 1000);
  }

  async function clickAddTask (){
    tasks.setNewTaskCreate(route.params.id)
    dialog.setLayout('TheItemTaskNewVsDialog')
    dialog.toggleViewDialogVisible()
    const result = await dialog.setDialogeDelete(false)
    
    if (result) {
      tasks.tasksSelectDelete = []
      await tasks.setTaskDatabase()
      await taskLists.getTaskList({id:route.params.id});
    }
    
  }
</script>

<style lang="scss" scoped>
.wrap {
  height: 100vh;
}


#panel {
	display: flex;
	align-items: center;
	flex-direction: column;
	color: rgb(33 33 33);
	/*background-color: var(--list-back-color);*/
	/*margin-bottom: 5.4rem;*/
	transition: all .3s;
	opacity: 0;
	height: 0;
	overflow: hidden;
	padding-bottom: 0;
}

#panel.open {
	/*max-height: none;*/
	opacity: 1;
	height: auto;
	padding-bottom: 4rem;
}
</style>
