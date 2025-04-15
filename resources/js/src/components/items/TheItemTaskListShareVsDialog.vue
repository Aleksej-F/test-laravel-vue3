<template>
  <div class="dialog-content">
    <h4
      v-if="!user.autchUser"
    >Для управления списком 
      <RouterLink :to="{ name: 'signup'}" class="routerLink"> 
          пройдите регистрацию
      </RouterLink> или 
      <RouterLink :to="{ name: 'login'}" class="routerLink"> 
                 авторизуйтесь
      </RouterLink>
    </h4>
    <div class="dialogAlertField"
      v-else
    >
      <h2>
        Добавить список для совместного использования?
      </h2>
    </div>
        
         
       
       
  </div>
</template>

<script setup>
    import { ref, computed, watch } from "vue";
    import { useRouter, useRoute, RouterLink } from "vue-router";

    import { useTasksStore } from '../../stores/tasks.js'
    import { useUsersStore } from '../../stores/Users.js'
    const user = useUsersStore()
    const tasks = useTasksStore() 
    
    const headerDialog = computed(() => {
   
    });
   




</script>

<style lang="scss" scoped>

</style>
