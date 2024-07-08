

<template>
    <Head title="Reunions" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des reunions</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ListReunion @currentReunion="getSelectedReunion" v-show="!showReunion"/>
                <DetailsReunion v-if="showReunion" :reunion/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import ListReunion from '@/Components/Reunion/ListReunion.vue';
import DetailsReunion from '@/Components/Reunion/DetailsReunionUser.vue';
    const showReunion = ref(false)

    const reunion = ref()
    const getSelectedReunion = (e)=>{
        reunion.value = e
        showReunion.value = true
    }

</script>
