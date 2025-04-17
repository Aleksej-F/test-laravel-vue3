<template>
	<div class="dialog-wrapper"
		v-if="dialog.visible"
	>
		<div class="dialog-black-box"></div>
		<div class="dialog-box rounded-2 light">
			
			<component :is="layout" />
			
			<div class="dialog-buttons">
				<div class="cancel-button button-d"
					@click.stop="noClickDialog()"
				>Отмена</div>
				<div class="ok-button button-d" 
					:class="{'disabled':  !user.autchUser}"
					v-if="dialog.dialogeDelete"
					@click.stop="yesClickDialog()"
				>Да</div>
				<div class="ok-button button-d" 
					:class="{'disabled': tasks.getTaskSelectTextLength == 0 || !user.autchUser}"
					@click.stop="okClickDialog()"
					v-else
				>Ok</div>
				
			</div>
		</div>
	</div>
</template>
<script setup>
	import { useRouter, useRoute } from 'vue-router'
	import { ref, computed, shallowRef } from 'vue'
	import { useTasksStore } from '../../stores/tasks.js'
	import { useTaskListStore } from "../../stores/taskList.js"
	import { useDialogStore } from "../../stores/dialog.js"
	import { useUsersStore } from '../../stores/Users.js'
	import TheItemTaskNewVsDialog from '../items/TheItemTaskNewVsDialog.vue'
	import TheItemTaskDeleteVsDialog from '../items/TheItemTaskDeleteVsDialog.vue'
	import TheItemTaskDeleteComletVsDialog from '../items/TheItemTaskDeleteComletVsDialog.vue'
	import TheItemTaskDeleteAllVsDialog from '../items/TheItemTaskDeleteAllVsDialog.vue'
	import TheItemTaskListDeleteAllVsDialog from '../items/TheItemTaskListDeleteAllVsDialog.vue'
	import TheItemTaskListDeleteComletVsDialog from '../items/TheItemTaskListDeleteComletVsDialog.vue'
	import TheItemTaskListDeleteVsDialog from '../items/TheItemTaskListDeleteVsDialog.vue'
	import TheItemTaskListShareVsDialog from '../items/TheItemTaskListShareVsDialog.vue'

	const route = useRoute()

	const taskLists = useTaskListStore();
	const tasks = useTasksStore()
	const props = defineProps(['message', ])
	const dialog = useDialogStore() 
	const user = useUsersStore()

	const itemTask = ref('')

	const layoutComponent = shallowRef( {
		TheItemTaskNewVsDialog, 
		TheItemTaskDeleteVsDialog,
		TheItemTaskDeleteAllVsDialog,
		TheItemTaskDeleteComletVsDialog,
		TheItemTaskListDeleteAllVsDialog,
		TheItemTaskListDeleteComletVsDialog,
		TheItemTaskListDeleteVsDialog,
		TheItemTaskListShareVsDialog
  	})

	const layout = computed(() => {
		return layoutComponent.value[dialog.layout]}
	)

	function noClickDialog() {
		dialog.setButtonClick({ok:false})
		dialog.toggleViewDialogVisible()
		
	}
	
	function yesClickDialog() {
		dialog.setButtonClick({ok:true})
		dialog.toggleViewDialogVisible()
	}

	async function okClickDialog() {
		dialog.setButtonClick({ok:true})
		dialog.toggleViewDialogVisible()
	}

</script>

<style lang="scss" scoped>
  .dialog-wrapper {
	display: flex;
	align-items: center;
	justify-content: center;
	position: fixed;
	top: 0;
	left: 0;
	width: 100vw;
	height: 100vh;
	z-index: 8000;
}



.dialog-black-box {
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	background-color: rgba(0,0,0,.7);
	z-index: 8000;
}

.dialog-box {
	max-width: 700px;
	width: 85%;
	background-color: #ebebeb;
	z-index: 8001;
	/*border-radius: 7px;*/
}

.dialog-content {
	padding: 1.3rem;
	font-family: 'Arial';
	font-size: 1rem;
	color: #363636;
		
	max-height: calc(100vh - 110px);
	overflow-y: scroll;
}



.dialog-content h4 {

	margin: .6rem 0 1.4rem 0;
	/*color: #3a3a3a;*/
	color: #000;
	font-weight: normal;
}


.dialog-buttons {
	width: 100%;
	display: flex;
	flex-direction: row;
	justify-content: flex-end;
	
	font-family: 'Arial';
	font-size: 1rem;
}

.ok-button, .cancel-button {
	display: flex;
	width: 50%;
	height: 4.5rem;
	align-items: center;
	justify-content: center;
	/*color: #0d6efd;*/
	color: var(--main-task-color);
	font-weight: bold;
	border-top: 1px #999 solid;
	user-select: none;
	-webkit-user-select: none;
}
.ok-button{
  border-radius: 0 0 0.7rem 0;
}
.cancel-button{
  border-radius: 0 0 0 0.7rem ;
}
.button-d{
  &:hover{
    background-color: #dbd8d8;
    cursor: pointer;
  }
}



.dialog-box.light>.dialog-buttons>.cancel-button, dialog-box.light>.dialog-buttons>.ok-button {
	/*filter: invert(1);*/
}


.ok-button {
	border-left: 1px #999 solid;
	
}

.ok-button.disabled {
	color: #999;
	pointer-events: none;
}

.ok-button:active, .cancel-button:active {
	background-color: var(--btn-active-color);
}


.rounded-2 {
	/*border: 1px #dee2e6 solid;*/
	/*border-radius: 0.375rem;*/
	border-radius: .7rem;
}


/* ----------------------------- Темная тема ------------------------------*/
.dialog-box.dark {
	background-color: rgb(50 50 50);
}


.dialog-box.dark>.dialog-content>h4 {
	color: #e3e3e3;
}

.dialog-box.dark .dialog-textarea {
	color: #aaaaaa;
}


/* ----------------------------- Темная тема ------------------------------*/
</style>
