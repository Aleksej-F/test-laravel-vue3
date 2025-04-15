<template>
	<div class="wrap2" 
		@click.stop="message.setMenuVisible()"
	>
		<TheLoader/>
		<MessageView/>
		<DialogView/>
		

		<div class="header tasks">
			<div class="headerLine">
				<RouterLink to="/">
					<div id="headerBackButton" class="headerButtons rounded-2">
						<img src="../assets/img/icons/arrow_back_black_24dp.svg">
					</div>
				</RouterLink>	
				<div id="tasksMenuButton" class="headerButtons rounded-2 light"
					@click.stop="clickMenuButton()"
				>
					<span class="menuBtnSymbol"></span>
				</div>
				<div id="tasksMenu" class="headerMenu dropdownMenu rounded-2 light"
					:class="{'show':showActive}"
				>
					<ul class="rounded-2">
						<li class="menu rounded-2"
							v-for="(item, index ) in listMenu"
								:key="index"
								:class="{'disabled': item.disabled }"
								@click.stop="clickImemMenu(item.func)"
						>
							<p v-if="item.visible">{{ item.name  }}</p>
						</li>
					</ul>
				</div>
			
				
				
			</div>
			<div class="headerLine title">
				<h6 id="tasksTitle">{{ taskLists.taskListSelect.text }}</h6>
			</div>
			<div class="headerLine time">
				<h6 id="tasksTime">{{ taskLists.taskListSelect.update_at }}</h6>				
			</div>	
		</div>
	</div >
  
</template>

<script setup>
	defineProps({
		
	})
	
	import TheLoader from './ui/LoaderView.vue';
	import MessageView from "./ui/MessageView.vue"
	import DialogView from './ui/DialogView.vue';
	
	import { ref, computed, watch } from 'vue'
	import { useRouter, RouterLink, useRoute} from 'vue-router'
	
	import { useTasksStore } from '../stores/tasks.js'
	import { useTaskListStore } from '../stores/taskList.js'
	import { useUsersStore } from '../stores/Users.js'
	import { useMessageStore } from '../stores/message.js'
	import { useDialogStore } from "../stores/dialog.js";
		
	const router = useRouter()
	const route = useRoute()
	
	const message = useMessageStore()
	const taskLists = useTaskListStore()
	const tasks = useTasksStore()
	const user = useUsersStore()
	const dialog = useDialogStore()

	const showActive = ref(false)

	const existence = computed(() => tasks.tasksLength == 0)
	const tasksComleted = computed(() => tasks.tasksCompleted.length == 0)
	const userAutch = computed(() => user.token !== null)
		
	const listMenu = ref ([
		{
			name:'Добавить задачу',
			link:'/',
			disabled: false,
			visible: true,
			func: clickAddTask
		},
		{
			name:'Удалить всё',
			link:'/',
			disabled: existence,
			visible: true,
			func: clickTasksDelete
		},
		{
			name:'Удалить завершённые',
			link:'/',
			disabled: tasksComleted,
			visible: true,
			func: clickDeleteTasksCompleted
		},

		// {
		// 	name:'Темная тема',
		// 	link:'/acoustics',
		// 	disabled: false,
		//visible:false
		// },
		// {
		// 	name:'Светлая тема',
		// 	link:'/acoustics',
		// 	disabled: false,
		//visible:false
		// },
		{
			name:'К спискам',
			link:'/',
			disabled: false,
			visible: true,
			func: clickGotoLists
		},
		
	])

	watch(()=> message.menuVisible, (menuVisible) => {
		// console.log('heder props.menuVisible - ', menuVisible)
		if (menuVisible) {
			showActive.value = false
		}
	})
	
	async function clickAddTask (){
		tasks.setNewTaskCreate(route.params.id)
		dialog.setLayout('TheItemTaskNewVsDialog')
   	dialog.toggleViewDialogVisible()
		const result = await dialog.setDialogeDelete(false)
    	if (result) {
			tasks.tasksSelectDelete = []
			await tasks.setTaskDatabase()
			await taskLists.getTaskList({id:route.params.id});
		}
	}

	function clickElementMenu(link){
		if (window.innerWidth > 480){
			router.push(link)
		}
	}

	function clickMenuNoVisible() {
		if (showActive.value) {
			showActive.value = false
		}
	}

	function clickMenuButton() {
		message.setMenuVisible()
		
		setTimeout(() => {
			showActive.value = !showActive.value;
		}, 100)
	}

	async function clickDeleteTasksCompleted() {
		dialog.setLayout('TheItemTaskDeleteComletVsDialog')
		dialog.toggleViewDialogVisible()
		message.setMenuVisible();
		const result = await dialog.setDialogeDelete(true)
		if (result) {
			tasks.setTasksSelectDelete(tasks.tasksCompleted.map((num) => num.id))
			await tasks.deleteTaskDatabase(tasks.tasksCompleted[0].id)
			await taskLists.getTaskList({id:tasks.tasksCompleted[0].list_id})
		}
	}

	function clickImemMenu(itemFunc){
		clickMenuNoVisible()
		itemFunc()
	}

	async function clickTasksDelete(params) {
		dialog.setLayout('TheItemTaskDeleteAllVsDialog')
		dialog.toggleViewDialogVisible()
		message.setMenuVisible();
		const result = await dialog.setDialogeDelete(true)
		if (result) {
			tasks.setTasksSelectDelete(tasks.tasks.map((num) => num.id))
			await tasks.deleteTaskDatabase(tasks.tasks[0].id)
			await taskLists.getTaskList({id:tasks.tasks[0].list_id})
		}
	}

	function clickGotoLists(){
		router.push({ name: 'home',} )
	}
</script>

<style lang="scss" scoped>
  .wrap2 {
    position: fixed;
    top: 0;
    left: 0;
   
    margin: 0 auto;
    width: 100%;
    /*height: 6rem;*/
    height: var(--header-height);
    z-index: 50;
    @media  (max-width: 768px) { 
      max-width: 100vw;
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

.menuBtnSymbol {
	font-size: 1.6rem;
	color: #5b5b5b;
	pointer-events: none;

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
	margin-top: 0;
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
p{
		padding: 0;
		margin: 0;
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