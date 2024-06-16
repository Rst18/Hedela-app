
<template>
    <Head title="Gestion des taches" />
    <GestionTache>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <ListGroupWithUsersTasks  :groups="groups"/>
            </div>
           

          
        </div>
    </GestionTache>
</template>


<script setup>
    import GestionTache from '@/Layouts/GestionTache.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import ListGroupWithUsersTasks from '@/Components/Tache/ListGroupWithUsersTaks.vue'
    import FormCreate from '@/Components/Tache/FormCreate.vue'
    import TimeSheetForm from '@/Components/Tache/TimeSheetForm.vue'
        const props = defineProps({ 
            groups:Array
        })
</script>
