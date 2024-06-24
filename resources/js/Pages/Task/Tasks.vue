<template>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Tâches
            </h2>
        </template>
        <div class=" py-4">
            <TasksList v-show="showComponent == 0" @task="getCurentTask"   :tasks="list_tasks"/>
        </div>
        <div v-if="showComponent == 1" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <DetailsTacheAdmin @hide="showComponent = 0" :task="taskSelected" />
        </div>
    </SideBarLayout>
</template>
<script setup>
    import {ref, onMounted} from 'vue'
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import TasksList from '@/Components/Tache/TasksList.vue';
    import DetailsTacheAdmin from '@/Components/Tache/DetailsTacheAdmin.vue';
        const props = defineProps({
            tasks:Array
        })
        const showComponent = ref(0)
        const list_tasks = ref([])
        const list = ref(true)
        const taskSelected = ref()
        const timesheet = ref(false)


        const getNewTask = (event)=>{
            list_taches.value.push(event)
            list.value = true
        }

        const getCurentTask = (e)=>{
            taskSelected.value = e
            showComponent.value = 1
        }

        const showTimesheets = (e)=>{
            taskSelected.value = e
            timesheet.value =  true
        }
        onMounted(() => {
          list_tasks.value = props.tasks  
        });
</script>