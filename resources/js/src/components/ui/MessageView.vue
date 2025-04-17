<template>
  <div class="cont-message"
    v-if="message.message"
    @click.stop="visibleFalse"
  >
  <!-- v-if="message.message" -->
    <div class="cont-message-cont">
      <div class="cont-message-view"
        :class="{'task': taskRout }"
      >
        <p 
          :class="classObject"
          v-html="message.message.mes"
        >
        </p>
      </div> 
    </div>
  </div>
</template>
<script setup>
  import { ref, computed } from 'vue'
  import { useMessageStore } from '../../stores/message.js'
  import { useRoute} from 'vue-router'
  const props = defineProps(['message'])
  const message = useMessageStore()
  
  const route = useRoute()
  
  const classObject = computed(()=> {
    const errClass = {
      error:  !message.message ? false: message.message.err,
      // message: !this.getMessage.err,
    }
    return errClass
  })


  
  const taskRout = computed(()=> {
    return route.name == "taskList" || route.name == 'taskListShare'
  })
    
  function visibleFalse(){
    message.setMessageVisibleFalse()
  }
 
  

</script>

<style lang="scss" scoped>
.cont-message{
  position: relative;
  z-index: 140;
  
  &-cont{
    position: absolute;
    
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(199, 223, 247, 0.678);
    z-index: 140;
  }
  
  &-view{
    
    min-height: 50px;
    min-width: 300px;
    // bottom: -40vh;
    max-width: 300px;
    max-height: 300px;
    
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--color-blue);
    border-radius: 10px;
    animation: move 0.3s linear;
    text-align: center;
    color: var(--color-white);
    padding: 15px;
    &.task{
      background-color: var(--main-task-color);
      color: aliceblue;
    }
    p{
      margin: 0;
    }
  }
}
.error{
  color: rgb(217 50 80);
}
@keyframes move {
    0% {
        transform: scaleY(0.5);
        opacity:  0.5;
    }
    100% {
        transform: scaleY(1);
        opacity:  1;
    }
  }
</style>
