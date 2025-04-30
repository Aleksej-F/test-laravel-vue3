<template>
  <section class="wrapper">
     
    
  </section>
</template>
 
<script setup>
  import { useRouter, RouterLink, useRoute } from 'vue-router'
  import { ref, computed, onMounted } from 'vue'
  
  import CloseView from "../components/ui/CloseView.vue"
  import { useUsersStore } from '../stores/Users.js'
  import { useMessageStore } from '../stores/message.js'
  import { useLoaderStore } from '../stores/Loader.js'
  
  
  const route = useRoute()
  const message = useMessageStore()
  const router = useRouter()
  const users = useUsersStore()    
  const loader = useLoaderStore()

  const count = ref( 0)
  const login = ref('')
  const password = ref('')
  const checkbox = ref(false)
  const authorize = ref(false)
    
  onMounted(async() => {
    loader.setIsLoaderStatus(true)
    let user = {}
    user = route.query
    // console.log('user.autchUser - ', route)
    // console.log('user.autchUser - ', user)
    // if (users.autchUser) {
    //   await taskLists.getTaskLists()
    // }
    
     const res = await users.setLogInBotTgUser(user)
     loader.setIsLoaderStatus(false)
    //  console.log('user.autchUser res- ', res)
    if (res) {
      authorize.value = true
    }
    if ( message.message){
      let timerId = setInterval(() => {
        if (!message.message){
          const page = "/"
          router.push({ path: page})
          clearTimeout(timerId)
        }
        }, 200);
    } else {
      setTimeout(() => {
        const page = "/"
        router.push({ path: page})
      }, 1000)
    }
    
  })
 
  
</script>

<style lang="scss" scoped>


@media (min-width: 1024px) {
  
}
</style>