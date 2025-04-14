<template>
	<div class="listItem leftPadding"
		@dblclick.stop="clickItemTaskList"
	>
		<div class="sortIcon">
			<img src="../../assets/img/icons/bars.svg">
		</div>
		<div class="contentWrapper "
			:class="{ 'uncomplite' : !item.complite,  'complite' : item.complite}"
		>
			<div class="content">
			<div class="text">{{ item.text }}</div>
			<div class="smallWrapper">
				<div class="small">{{ item.update_at }}</div>
				<div class="small">
					<div
						v-if="tasksLength == 0"
					>
						Нет задач
					</div>
					<div
						v-else-if="tasksCompleted==tasksLength"
					>
						Задачи завершены
					</div>
					<div
						v-else
					>
						Завершено: {{ tasksCompleted }} из {{  tasksLength }}
					</div>
					<img src="../../assets/img/icons/angle-right.svg">
				</div>
			</div>
			</div>
		</div>
		<div class="selectItem rounded-2">
			<img src="../../assets/img/icons/check.svg">
		</div>
		<div class="menuWrapper"
			@click.stop="clickShowVisible()"
		>
			<div class="headerButtons rounded-2">
				<span class="tasksBtnSymbol"></span>
			</div>
			<div class="dropdownMenu rounded-2"
				:class="{'show': showVisible}"
			>
				<ul class="rounded-2">
					<li class="menu rounded-2"
						@click.stop="editTaskList(item)"
					>Редактировать</li>
					<li class="menu rounded-2"
						@click.stop="deleteTaskList(item.id)"
					>Удалить</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { ref, computed, watch } from 'vue'
	import { useRouter, useRoute } from 'vue-router'
	import { useTaskListStore } from '../../stores/taskList.js'
	import { useMessageStore } from '../../stores/message.js'
	import { useDialogStore } from "../../stores/dialog.js"

	const message = useMessageStore()
  	const taskLists = useTaskListStore()
	const dialog = useDialogStore()

	const showVisible = ref(false)
		
	const route = useRoute()
	const router = useRouter()

	const props = defineProps(['item', 'index', 'menuVisible'])



	
	// console.log(route.meta.autch)
	watch(()=> message.menuVisible, (menuVisible) => {
		// console.log(' item props.menuVisible - ', menuVisible)
		if (menuVisible) {
			showVisible.value = false
		}
	})

	function clickShowVisible() {
		message.setMenuVisible();
		setTimeout(() => {
			showVisible.value = !showVisible.value;
		}, 100)
	}

	const tasksLength = computed(() => {
		return props.item.tasks.length 
	})

	const tasksCompleted = computed(() => {
		return props.item.tasks.filter((word) => word.complite).length 
	})

	function clickItemTaskList(params) {
		message.setMenuVisible()
		router.push({ name: 'taskList', params: { id: props.item.id } })
		
	}

	async function editTaskList(item){
		message.setMenuVisible()
		taskLists.setTaskListCreate(item)
		taskLists.toggleViewCreateTaskListVisible()
	}
	
	async function deleteTaskList(id){
		dialog.setLayout('TheItemTaskDeleteVsDialog')
		dialog.toggleViewDialogVisible()
		message.setMenuVisible();
		const result = await dialog.setDialogeDelete(true)
		if (result) {
			await taskLists.deleteTaskListDatabase(id)
			await taskLists.getTaskLists()
		}
	}
</script>

<style lang="scss" scoped>
 
.listItem {
	position: relative;
	width: 98%;
	pointer-events: auto;
	display: flex;
	/*align-items: center;*/
	padding: .6rem .6rem .6rem 1rem;
	background-color: var(--list-item-color);

	/*border: 1px #dee2e6 solid;*/
	color: #212529;
	border-radius: 1rem;

	line-height: 1.5;
	font-size: 1.1rem;
	/*font-weight: 400;*/
	margin: 2px 0;
	height: auto;
	transition: transform .4s;

	/*transition-delay .3s;*/
	/*transition: .2s background-color;*/
  transition: background-color 0.2s ease-out 0.1s;
  &:hover{
    
    background-color: #c0bcbc;

  }
}

.listItem.animRight {
	z-index: 9000;
	transform: translate(90vw, 0) rotate(270deg) scale(.2);
}


.listItem.animLeft {
	z-index: 9000;
	transform: translate(-100vw, 0) rotate(-270deg) scale(.6);
}

.listItem.leftPadding {
	padding-left: .6rem;
}

.noAction {
	pointer-events: none;
}



.form-check-input {
	margin: .4rem 0.6rem .3rem 0;
	width: 1.2rem;
	height: 1.2rem;
}


.form-check-input.disabled {
	pointer-events: none;
}


.selectItem {
	display: flex;
	justify-content: flex-start;
	align-items: center;
	padding-left: 1rem;
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	/*pointer-events: none;*/
	color: #fff;
	visibility: hidden;
	background-color: rgba(127, 127, 127, 0);
	/*transition: .3s background-color;*/
	/*border-radius: 6px;*/
	transition: .2s background-color;
}


.selectItem.active {
	/*background-color: rgba(127, 127, 127, 0.7);*/
	background-color: var(--select-color);
	visibility: visible;
	/*opacity: 1;*/
}

.selectItem img {
	margin-left: 1rem;
	height: 2rem;
	pointer-events: none;
}
.menuWrapper:hover {
	cursor: pointer;

	& .headerButtons{
		cursor: pointer;
		transform: scale(1.5, 1.5);
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
.menu{
	&:hover{
		cursor: pointer;
		background-color: #d3d0d0;
	}
}
.rounded-2 {
    /* border: 1px #dee2e6 solid; */
    /* border-radius: 0.375rem; */
    border-radius: .7rem;
}


.complite {
	text-decoration: line-through;
	/*background: rgb(169 169 169);
   color: rgb(240 248 255);*/
	/*color: rgb(13, 110, 253) !important;*/
	color: var(--main-task-color) !important;
}

.uncomplite:last-of-type {
	margin-bottom: 2rem;
}

.complite,
.uncomplite {
	position: relative;
	/*width: calc(100% - var(--menu-wrapper) - 1px);*/
}

</style>