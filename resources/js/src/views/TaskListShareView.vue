<template>
    <div>
        
        <TheHeaderTask />
        <TheTasksShare />
    </div>
</template>

<script setup>
    import { onMounted } from "vue"
    import { useRouter, useRoute } from 'vue-router'
    import TheHeaderTask from '../components/TheHeaderTasks.vue'
    import TheTasksShare from '../components/TheTasksShare.vue'
    import { useDialogStore } from "../stores/dialog.js"
    import { useTaskListStore } from "../stores/taskList.js"
    
    const route = useRoute()
    const router = useRouter()
    const dialog = useDialogStore() 
    const taskLists = useTaskListStore()

    onMounted(async () => {
        setTimeout(async() => {
            dialog.setLayout('TheItemTaskListShareVsDialog')
            
            dialog.toggleViewDialogVisible()
            const result = await dialog.setDialogeDelete(true)
            if (result) {
                await taskLists.appendTaskListDatabase({id:route.params.id});
                setTimeout(async() => {
                     router.push({ name: 'taskList', params: { id: route.params.id } })
                 }, 2000);
            }
        
        }, 2000);
      
  });
</script>

<style lang="scss" scoped>
    .share{
        width: 100vw;
        height: 100vh;
        position: absolute;
        z-index: 1000;
        left: 0;
        background-color: rgb(157 160 160 / 27%);
        opacity: 0;
    }
    .visible{
        opacity: 1;
        transition: 4s opacity ease 1s;
    }
</style> 