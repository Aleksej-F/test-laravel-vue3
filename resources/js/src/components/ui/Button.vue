<template>
 <div class="button" 
  :title = "title"
 >
  <div
   v-if="visibleBack"
   >
      <svg width="26" height="26" viewBox="0 0 36 36" fill="none">
        <path class="svg" d="M21.7956 23.2752C22.185 23.6655 22.1851 24.2971 21.7959 24.6875L21.6937 24.79C21.3031 25.1819 20.6686 25.182 20.2777 24.7905L14.2051 18.7064C13.8155 18.3161 13.8155 17.6839 14.2051 17.2936L20.2777 11.2095C20.6686 10.818 21.3031 10.8181 21.6937 11.21L21.7959 11.3125C22.1851 11.7029 22.185 12.3345 21.7956 12.7248L16.5328 18L21.7956 23.2752Z" 
          fill="#269EB7"/>
      </svg>
  </div>
  <div>
    {{name}}
  </div>
    
</div>
</template>
<script setup>
  import { RouterLink } from 'vue-router'
  
  const props = defineProps(['toLink','title', 'name','visibleBack'])

</script>

<style lang="scss" scoped>
  .button{
    margin: 10px;
    padding: 0 ;
    height: 36px;
    border: 1px solid var(--color-blue);
    border-radius: 6px;
    font-weight: 400;
    font-size: 18px;
    line-height: 24px;
    color: var(--color-blue);
    display: flex;
    justify-content: center;
    align-items: center;

    &>div{
      margin: 0 10px;
      display: flex;
      align-items: center;
    }
    &:hover{
      cursor: pointer;
      background: var(--color-blue);
      color: var(--color-white);
      .svg{
        fill:var(--color-white);
      }
    }

  }
</style>
