

<template>
    <Head title="Reunions" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Création d'une réunion</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <FormCreate :reunion="{}" action="add" :types/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import FormCreate from '@/Components/Reunion/FormCreate.vue';

        const props = defineProps({
           // users:Object,
            types:Object
          
        })

</script>
