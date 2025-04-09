<template>
 <div class="wrap2" 
    @click.stop="clickMenuNoVisible()"
  >
    <TheLoader/>
    <MessageView/>
    <ListCreateDialog/>
    <div class="header-logo">
      <RouterLink to="/">
      
      </RouterLink>
    </div>
    <div class="header list">
			<div class="headerLine">
	
				<div id="mainMenu" class="rounded-2">
					<img src="../assets//img/icons/list-check.svg">
				</div>
				
				<div class="appTitle">Simple Task List</div>
					
				<div id="listMenuButton" class="headerButtons rounded-2"
           @click.stop="clickMenuButton()"
        >
					<span class="menuBtnSymbol"></span>
				</div>
					
			</div>
			<div class="headerLine sort">
				<div id="sortMenuOut" class="rounded-2"
          @click.stop="clickSortButton()"
        >
          <div class="choose_mnu_wrapper">
            <div class="choose_mnu_arrow"
              
            >
              <div class="menuIcon">
                <img src="../assets//img/icons/bars-sort.svg">
              </div>
            </div>
            <div class="current_text">статус ↑</div>
            <div class="items_wrapper rounded-2"
              :class="{'active': sortActive}"
            >
              <div class="choose_item rounded-2 light">дата ↓</div>
              <div class="choose_item rounded-2 light">дата ↑</div>
              <div class="choose_item rounded-2 light">название ↓</div>
              <div class="choose_item rounded-2 light">название ↑</div>
              <div class="choose_item rounded-2 light">статус ↓</div>
              <div class="choose_item rounded-2 light active">статус ↑</div>
            </div>
          </div>
        </div>
			</div>
			
			<div id="listMenu" class="headerMenu dropdownMenu rounded-2 light"
        :class="{'show':showActive}"
        @click="clickMenuButton()"
      >
				<ul>
					<li  class="menu rounded-2"
            v-for="(item, index ) in listMenu"
            :key="index"
            :class="{'disabled': item.disabled }"
             @click="item.func"
          >{{ item.name  }}</li>
					
				</ul>
			</div>
		</div>
  </div >
  
</template>

<script setup>
  defineProps({
    
  })
  import TheLoader from './ui/LoaderView.vue';
  import MessageView from "./ui/MessageView.vue"
  import ListCreateDialog from "./ui/ListCreateDialog.vue"
  import { ref, computed } from 'vue'
  import { useRouter, RouterLink } from 'vue-router'
  const sortActive = ref(false)
  const showActive = ref(false)
  const router = useRouter()
  
  import { useTaskListStore } from '../stores/taskList.js'
  const taskLists = useTaskListStore()
  
  const listMenu = ref ([
    {
      name:'Добавить список',
      link:'/grillato',
      disabled: false,
      func: taskLists.toggleViewCreateTaskListVisible()
    },
    {
      name:'Удалить всё',
      link:'/rockfon',
      disabled: true
    },
    {
      name:'Удалить завершённые',
      link:'/acoustics',
      disabled: true
    },
    {
      name:'Темная тема',
      link:'/acoustics',
      disabled: false
    },
    {
      name:'Светлая тема',
      link:'/acoustics',
      disabled: false
    },
  ])


  function clickElementMenu(link){
   
    if (window.innerWidth > 480){
          router.push(link)
    }
    
  }

  function clickMenuButton() {
    clickMenuNoVisible()
    showActive.value = !showActive.value
    
    
  }
  function clickMenuNoVisible() {
    if (showActive.value) {
      showActive.value = false
    }
    if (sortActive.value) {
      sortActive.value = false
    }
  }
  function clickSortButton() {
    sortActive.value = !sortActive.value
    
  }
</script>

<style lang="scss" scoped>
  .wrap2 {
    position: fixed;
    top: 0;
    left: 0;
   
    margin: 0 auto;
    width: 100vw;
    /*height: 6rem;*/
    height: var(--header-height);
    z-index: 50;
    @media  (max-width: 768px) { 
      max-width: 90vw;
    }

  }
  

.header {
	position:relative;
	max-width: 1100px;
	margin: 0 auto;
	// width: 100vw;
	/*height: 6rem;*/
	height: var(--header-height);
	padding: 0 1rem;
	display: flex;
	justify-content: space-around;
	align-items: flex-start;
	flex-direction: column;
	background-color: cornflowerblue;
	z-index: 50;
	
}

.header.tasks {
	/*background-color: rgb(100 149 237);*/
	background-color: var(--main-task-color);
	border-radius: 0 0 .7rem .7rem;
}

.header.list {
	/*background-color: rgb(95 158 160);*/
	background-color: var(--main-list-color);
	border-radius: 0 0 .7rem .7rem;
}

.headerLine {
	width: 100%;
	/*padding: 5px 0;*/
	display: flex;
	align-items: center;
	justify-content: space-between;
	align-items: center;
	color: #fff;
}

.headerLine h6 {
	/*text-transform: uppercase;*/
	margin: 0;
}

.headerLine.sort {
	justify-content: flex-end;
}

.headerLine.title {
	width: 96%;
	overflow: hidden;
	white-space: nowrap;
	justify-content: space-between;
}

.headerLine.title h6 {
	margin: 0 0 0 .5rem;
	color: aliceblue;
	font-size: 1.2rem;
	text-overflow: ellipsis;
	overflow: hidden;
	font-weight: 300;
}

.headerLine.time {
	justify-content: space-between;
}


.headerLine.time h6 {
	color: gainsboro;
	font-size: 0.7rem;
	font-style: italic;
	margin: 0 0 0 .6rem;
	font-weight: 300;
}


#mainMenu {
	width: 2rem;
	height: 2rem;
	display: flex;
	justify-content: center;
	align-items: center;
	position: relative;
	/*cursor: pointer;*/
	display: none;
}


#mainMenu img {
	width: 60%;
	pointer-events: none;
}

.headerButtons {
	-webkit-tap-highlight-color: rgb(0 0 0 / 0%);
	border-radius: 50%;
	width: 100%;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	position: relative;
	cursor: pointer;


	position: relative;
	overflow: hidden;

}

#listMenuButton, #tasksMenuButton, #headerBackButton {
	width: 2rem;
	height: 2rem;
	display: flex;
	justify-content: center;
	align-items: center;
	cursor: pointer;
}



.headerButtons img {
	width: 75%;
	pointer-events: none;
}



.menu.rounded-2 {
	/*border: 1px #dee2e6 solid;*/
	/*border-radius: 0.375rem;*/
	border-radius: .7rem;
	&:hover{
		cursor: pointer;
		background-color: rgb(195 195 195)
	}
}

#sortMenuOut{
  &:hover{
		cursor: pointer;
		
	}
}


.dropdownMenu {
	position: absolute;
	top: 2rem;
	right: .6rem;
	z-index: 100;
	opacity: 0;
	visibility: hidden;
	background-color: #fff;

	/*border: 1px #dee2e6 solid;*/
	box-shadow: 0 .5rem 1rem rgba(33, 37, 41, .15);


	font-family: var(--system-font);
	/*pointer-events: none;*/
	transition: opacity 0.3s;
}


.dropdownMenu.show {
	opacity: 1;
	visibility: visible;
	pointer-events: auto;

}


.dropdownMenu>ul {
	padding: 0 .5rem;
	margin: .5rem 0;

}


.dropdownMenu>ul>li {
	list-style-type: none;
	padding: .5rem 1rem;
	color: var(--menu-item-color);
	/*background-color: #fff;*/
	font-size: 1rem;
	user-select: none;
	-webkit-user-select: none;
}


.dropdownMenu>ul>li.disabled {
	pointer-events: none;
	color: #999;
}

.dropdownMenu>ul>li:active {
	background-color: var(--btn-active-color);
}
.rounded-2 {
    /* border: 1px #dee2e6 solid; */
    /* border-radius: 0.375rem; */
    border-radius: .7rem;
}
</style>