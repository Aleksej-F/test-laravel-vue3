<template>
  
  <section class="main">
      <div class="wrap wrap-container">
        <div class="wrap main-container">
          <h1>Помощник для планирования и контроля мероприятий, задач, покупок.</h1>
          
        </div>
      </div>
    </section>
   
</template>

<script setup>

</script>

<style lang="scss" scoped>

.main{
  height: 100vh;
  background-image: url(../assets/img/скрин-1.jpg);
  background-attachment: fixed;
  background-size: cover;
  background-position: center;
  @media  (max-width: 768px) { 
    height: 100vw;
  }
  &-container{
    display: flex;
    justify-content: center;
    align-items: center;
    & h1{
      
      overflow: clip;
    }
    
  }
}



</style>./TheHomeProjects.vue