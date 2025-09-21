<template>
    <div>
        <div id="tasksScreen" class="screens active">
            <!-- @click.stop="setNoVisibleMenu()" -->
            <div class="wrap">
                <div class="sortMenuOut"></div>
                <div id="tasksListOut" class="light">
                    <div class="list-group" 
                      v-if="tasks.tasksLength > 0"
                      >
                        <TransitionGroup name="list" tag="ul">
                          <TheItemTask
                              v-for="(item, index) in tasks.tasksNoCompleted"
                              :key="+item.id"
                              :item="item"
                              :menuVisible="menuVisible"
                          />
                        </TransitionGroup>
                    </div>
                    <div class="list-group" v-else>
                        <p>
                            {{ tesxNoTasks }}
                        </p>
                    </div>
                

                  <div class="compliteTaskPanelHeader"
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
                  </div>
                </div>
                <div
                    class="addTaskButton active"
                    title="Добавить"
                    @click.stop="clickAddTask()"
                >
                    <span class="plusWrapper">
                        <span class="plusVert"></span>
                        <span class="plusHoriz"></span>
                    </span>
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

  import TheItemTask from "./items/TheItemTask.vue";

  const route = useRoute()

  const taskLists = useTaskListStore();
  const user = useUsersStore();
  const tasks = useTasksStore() 
  const dialog = useDialogStore() 

  const tesxNoTasks = computed(() => {
      if (user.autchUser) {
          return "В этом списке нет задач. Создайте их.";
      } else {
          return "Для просмотра списков авторизуйтесь.";
      }
  });

  const taskComplitedVisible = ref(false);
  const menuVisible = ref(false);
  const taskListId = ref(route.params.id);
  
  onMounted(async () => {
      
      if (user.autchUser) {

        await taskLists.getTaskList({id:route.params.id});
        
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

.list-move, /* применять переход к движущимся элементам */
.list-enter-active,
.list-leave-active {
  transition:  all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

/* убедитесь, что удаляющиеся элементы выведены из потока, чтобы 
анимации перемещения могли быть рассчитаны правильно. */
.list-leave-active {
  position: absolute;
}
</style>
