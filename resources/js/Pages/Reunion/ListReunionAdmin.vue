

<template>
    <Head title="Reunions" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des reunions (Administration)</h2>
        </template>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ListReunion :is_Admin="1" @currentReunion="getSelectedReunion" v-show="!showReunion"/>
                <DetailsReunionAdmin @close-me="showReunion = false" v-if="showReunion" :reunion/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import ListReunion from '@/Components/Reunion/ListReunion.vue';
import DetailsReunionAdmin from '@/Components/Reunion/DetailsReunionAdmin.vue';
    const showReunion = ref(false)

    const reunion = ref()
    const getSelectedReunion = (e)=>{
        reunion.value = e
        showReunion.value = true
    }

</script>
