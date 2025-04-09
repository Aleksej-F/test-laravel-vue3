<template>
  <div >
    
 
    <div id="listScreen" class="screens active">
      <div class="wrap">
        <div class="sortMenuOut"></div>
        <div id="mainListOut" class="light">
          <div class="list-group">
            <TheItemList
              v-for="(item, index ) in taskLists.taskLists" 
              :key="+item.id"
              :item="item"
            />
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

  const taskLists = useTaskListStore()
  
  onMounted(async() => {
    await taskLists.getTaskLists()
  })
  

</script>

<style lang="scss" scoped>
  .wrap{
    height: 100vh;
  }



</style>