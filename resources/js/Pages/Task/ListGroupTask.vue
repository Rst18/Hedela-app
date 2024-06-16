
<template>
    <Head title="Gestion des taches" />
    <GestionTache>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste groupe avec tâches
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <ListGroupWithTasks :taches="taches" :groups="groups"/>
            </div>

          
        </div>
    </GestionTache>
</template>


<script setup>
    import GestionTache from '@/Layouts/GestionTache.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import ListGroupWithTasks from '@/Components/Tache/ListGroupWithTasks.vue'
    import FormCreate from '@/Components/Tache/FormCreate.vue'
    import TimeSheetForm from '@/Components/Tache/TimeSheetForm.vue'
        const props = defineProps({
            taches:Array,
            groups:Array
        })
</script>
