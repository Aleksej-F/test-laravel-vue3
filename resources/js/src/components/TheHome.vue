<template>
  <div >
    
 
    <div id="listScreen" class="screens active">
      <div class="wrap">
        <div class="sortMenuOut"></div>
        <div id="mainListOut" class="light">
          <div class="list-group"
            v-if="taskLists.taskListLength > 0"
          >
            <TheItemList
              v-for="(item, index ) in taskLists.taskLists" 
              :key="+item.id"
              :item="item"
            />
          </div>
          <div class="list-group"
            v-else
          >
            <p >
              Для просмотра списков авторизуйтесь.
            </p>
          </div>
        </div>
        
        <div class="addListButton active"
          title="Добавить список"
          @click.stop="taskLists.toggleViewCreateTaskListVisible()"
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
  import TheItemList from './items/TheItemList.vue';
  import { onMounted } from 'vue'
  import { ref, computed } from 'vue'
  import { useTaskListStore } from '../stores/taskList.js'
  import { useUsersStore } from '../stores/Users.js'

  const taskLists = useTaskListStore()
  const user = useUsersStore()

  onMounted(async() => {
    console.log('user.autchUser - ', user.autchUser)
    if (user.autchUser) {
      await taskLists.getTaskLists()
    }
    
  })
  

</script>

<style lang="scss" scoped>
  .wrap{
    height: 100vh;
  }



</style>