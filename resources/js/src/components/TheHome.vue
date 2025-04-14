<template>
  <div >
    <div id="listScreen" class="screens active"
     
    > 
    <!-- @click.stop="setNoVisibleMenu()" -->
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
              :menuVisible = "menuVisible"
            />
          </div>
          <div class="list-group"
            v-else
          >
            <p >
              {{ tesxNoTaskLists }}
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
  import TheHeader from './TheHeader.vue';
  const taskLists = useTaskListStore()
  const user = useUsersStore()

  const tesxNoTaskLists = computed(() => {
    if(user.autchUser){
      return "У Вас нет списков. Создайте их."
    } else {
      return "Для просмотра списков авторизуйтесь."
    }
  
  })

  const menuVisible = ref(false)
  onMounted(async() => {
    console.log('user.autchUser - ', user.autchUser)
    if (user.autchUser) {
      await taskLists.getTaskLists()
    }
    
  })
  function setNoVisibleMenu() {
    // console.log('menuVisible.value - ', menuVisible.value)
    menuVisible.value = true
    setTimeout(() => menuVisible.value = false, 1000);
  }

</script>

<style lang="scss" scoped>
  .wrap{
    height: 100vh;
  }



</style>