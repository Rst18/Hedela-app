<template>
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestion des Tâches
            </h2>
        </template>
        
        <div  class="max-w-7xl py-6 mx-auto sm:px-6 lg:px-8">
            <FormCreate
                option="add"
                
                :task="form"
            />
        </div>
    </SideBarLayout>
</template>
<script setup>
    import {  FwbButton, } from 'flowbite-vue'
    import {ref, onMounted} from 'vue'
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    // import { Head } from '@Inertiajs/inertia-vue3';
    
    import FormCreate from '@/Components/Tache/FormCreate.vue'

    const form = {
        nom:"",
        description:'',
        date_limite:'',
        statut:'',
        priorite:''
    }
        
</script>