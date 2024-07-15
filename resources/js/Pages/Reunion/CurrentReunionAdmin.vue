

<template>
    <Head title="Reunion" />

    <ReunionLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Code Reunion : {{ reunion.id }} (Admin)</h2>
        </template>
        <div class="py-4">
            <div class="min-h-screen mx-auto sm:px-6 lg:px-4 bg-white">
               <ReunionJoined :reunion :is_Admin="1"/>
               
            </div>
        </div>
    </ReunionLayout>
</template>
<script setup>
import ReunionLayout from '@/Layouts/ReunionLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import ReunionJoined from '@/Components/Reunion/ReunionJoined.vue';
    const props = defineProps({
        reunion:Object
    })
</script>
