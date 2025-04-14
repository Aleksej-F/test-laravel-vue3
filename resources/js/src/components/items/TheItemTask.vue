<template>
   <div class="listItem" 
		@click.stop="clickItemTaskList"
	>
        <div class="sortIcon">
            <img src="../../assets/img/icons/bars.svg" />
        </div>
        <label>
            <input class="form-check-input" type="checkbox" 
                v-model="item.complite"
                @click="clickCheckTask()"
            />
        </label>
        <div class="contentWrapper uncomplite">
            <div class="content">
					<div class="text">{{ item.text }}</div>
					<div class="smallWrapper">
						<div class="small">{{ smallText }}</div>
					</div>
            </div>
        </div>
        <div class="selectItem rounded-2"><img src="../../assets/img/icons/check.svg" /></div>
        <div class="menuWrapper"
            @click.stop="clickShowVisible()"
        >
            <div class="headerButtons rounded-2"
				
			>
				<span class="tasksBtnSymbol"></span>
            </div>
            <div class="dropdownMenu rounded-2"
                :class="{'show': showVisible}"
                @click.stop="clickShowVisible()"
            >
                <ul class="rounded-2">
                    <li class="menu rounded-2"
                        @click.stop="editTask(item)"
                    >Редактировать</li>
                    <li class="menu rounded-2"
                        @click.stop="deleteTask(item.id)"
                    >Удалить</li>
                </ul>
            </div>
        </div>
   </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useTaskListStore } from "../../stores/taskList.js";
import { useMessageStore } from "../../stores/message.js";
import { useTasksStore } from '../../stores/tasks.js'
import { useDialogStore } from "../../stores/dialog.js";

const message = useMessageStore();
const taskLists = useTaskListStore();
const tasks = useTasksStore() 
const dialog = useDialogStore()

const showVisible = ref(false);

const route = useRoute();
const router = useRouter();

const props = defineProps(["item", "index", "menuVisible"]);

// console.log(route.meta.autch)
watch(
    () => message.menuVisible,
    (menuVisible) => {
        // console.log(' item props.menuVisible - ', menuVisible)
        if (menuVisible) {
            showVisible.value = false;
        }
    }
);

const smallText = computed(() => {
   //  console.log(props.item.tasks.length);
    return props.item.smallText && props.item.smallText.length > 0 ?	props.item.smallText : "нет комментария";
});

function clickShowVisible() {
    message.setMenuVisible();
    setTimeout(() => {
        showVisible.value = !showVisible.value;
    }, 100)
}

async function clickCheckTask(){
	const item = {... props.item}
	item.complite = !item.complite
	tasks.setTaskCreate( item);
	await tasks.updateTaskDatabase({mes: false});
}

function clickItemTaskList(params) {
   message.setMenuVisible();
}

async function editTask(item) {
    tasks.setTaskCreate({... item});
    dialog.setLayout('TheItemTaskNewVsDialog')
    dialog.toggleViewDialogVisible()
    message.setMenuVisible()
    dialog.setDialogeDelete(false)
}

async function deleteTask(id) {
    
	dialog.setLayout('TheItemTaskDeleteVsDialog')
    dialog.toggleViewDialogVisible()
    message.setMenuVisible();
    const result = await dialog.setDialogeDelete(true)
    if (result) {
        tasks.tasksSelectDelete = []
        await tasks.deleteTaskDatabase(id);
        await taskLists.getTaskList({id:route.params.id});
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
    padding: 0.6rem 0.6rem 0.6rem 1rem;
    background-color: var(--list-item-color);

    /*border: 1px #dee2e6 solid;*/
    color: #212529;
    border-radius: 1rem;

    line-height: 1.5;
    font-size: 1.1rem;
    /*font-weight: 400;*/
    margin: 2px 0;
    height: auto;
    transition: transform 0.4s;

    /*transition-delay .3s;*/
    /*transition: .2s background-color;*/
    transition: background-color 0.2s ease-out 0.1s;
    &:hover {
        cursor: pointer;
        background-color: #c0bcbc;
    }
}

.listItem.animRight {
    z-index: 9000;
    transform: translate(90vw, 0) rotate(270deg) scale(0.2);
}

.listItem.animLeft {
    z-index: 9000;
    transform: translate(-100vw, 0) rotate(-270deg) scale(0.6);
}

.listItem.leftPadding {
    padding-left: 0.6rem;
}

.noAction {
    pointer-events: none;
}

.form-check-input {
    margin: 0.4rem 0.6rem 0.3rem 0;
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
    transition: 0.2s background-color;
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
    right: 0.6rem;
    z-index: 100;
    opacity: 0;
    visibility: hidden;
    background-color: #fff;

    /*border: 1px #dee2e6 solid;*/
    box-shadow: 0 0.5rem 1rem rgba(33, 37, 41, 0.15);

    font-family: var(--system-font);
    /*pointer-events: none;*/
    transition: opacity 0.3s;
}

.dropdownMenu.show {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}

.dropdownMenu > ul {
    padding: 0 0.5rem;
    margin: 0.5rem 0;
}

.dropdownMenu > ul > li {
    list-style-type: none;
    padding: 0.5rem 1rem;
    color: var(--menu-item-color);
    /*background-color: #fff;*/
    font-size: 1rem;
    user-select: none;
    -webkit-user-select: none;
}

.dropdownMenu > ul > li.disabled {
    pointer-events: none;
    color: #999;
}

.dropdownMenu > ul > li:active {
    background-color: var(--btn-active-color);
}
.menu {
    &:hover {
        background-color: #d3d0d0;
    }
}
.rounded-2 {
    /* border: 1px #dee2e6 solid; */
    /* border-radius: 0.375rem; */
    border-radius: 0.7rem;
}
</style>
