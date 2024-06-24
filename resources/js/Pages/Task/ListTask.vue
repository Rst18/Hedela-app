
<template>
    <!-- <Head title="Gestion des taches" /> -->
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Tâches
            </h2>
        </template>
        <div class=" py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" v-show="!timesheet" >
              
                <div class="grid grid-cols-12 py-1 shadow-sm rounded-sm px-4 gap-2">
                    <fwb-button  @click="list = true" class="rounded-lg mt-2 col-span-6 lg:col-span-2 hover:bg-gray-200 hover:dark:bg-gray-600 border">
                        Liste
                    </fwb-button>
                    <fwb-button @click="list = false"   class="rounded-lg mt-2 col-span-6 lg:col-span-2 hover:bg-gray-200 hover:dark:bg-gray-600 border">
                        Créer
                    </fwb-button>
                   
                </div>


               <TasksList v-show="list" @task="getCurentTask"   :tasks="list_tasks"/>
            </div>
            <div v-if="timesheet == 1" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <DetailsTache @hide="timesheet=0" :task="taskSelected" />

            </div>
            <div v-if="!list">
                <FormCreate option="add" :task="{}"/>
            </div>
           
        </div>
    </SideBarLayout>
</template>


<script setup>

    import {  FwbButton, } from 'flowbite-vue'
    import {ref, onMounted} from 'vue'
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import FormCreate from '@/Components/Task/FormCreate.vue'
    import DetailsTache from '@/Components/Task/DetailsTache.vue'
    import TasksList from '@/Components/Task/TasksList.vue';
        const props = defineProps({
            tasks:Array
        })

        const list_tasks = ref([])
        const list = ref(false)
        const taskSelected = ref()
        const timesheet = ref(false)


        const getNewTask = (event)=>{
            list_taches.value.push(event)
            list.value = true
        }

        const getCurentTask = (e)=>{
            taskSelected.value = e
            timesheet.value = 1
        }

        const showTimesheets = (e)=>{
            taskSelected.value = e
            timesheet.value =  true
        }
        onMounted(() => {
        //  list_tasks.value = props.tasks  
        });
</script>
