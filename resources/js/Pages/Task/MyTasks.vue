<template>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Tâches
            </h2>
        </template>
        <div class=" py-4">
            <MyTasksList v-show="showComponent == 0" @task="getCurentTask"  />
        </div>
        <div v-if="showComponent == 1" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <DetailsTache @hide="showComponent = 0" :task="taskSelected" />
            </div>
    </SideBarLayout>
</template>
<script setup>
    import {ref, onMounted} from 'vue'
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    // import { Head } from '@Inertiajs/inertia-vue3';
    import DetailsTache from '@/Components/Tache/DetailsTache.vue'
    import MyTasksList from '@/Components/Tache/MyTasksList.vue';
        const props = defineProps({
            tasks:Array
        })
        const showComponent = ref(0)
        const list_tasks = ref([])
        const taskSelected = ref()

        const getCurentTask = (e)=>{
            taskSelected.value = e
            showComponent.value = 1
        }
        onMounted(() => {
          list_tasks.value = props.tasks  
        });
</script>