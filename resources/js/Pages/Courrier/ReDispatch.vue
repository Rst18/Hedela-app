

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Courriers Dispatchés</h2>
        </template>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ListCourriers 
                type_list="ReDispatch"
                v-if="!showDetail"
                @selectedCourrier="getSelectedCourrier"
            />
           <DetailsCourrier v-else :courrier="courrierData" @closeMe="showDetail = !showDetail" />
        </div>

    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/Courrier/Formulaire.vue'
import {ref,onMounted} from 'vue'
import { FwbButton } from 'flowbite-vue'
import ListCourriers from '@/Components/Courrier/ListCourriers.vue'
import DetailsCourrier from '@/Components/Courrier/DetailsCourrier.vue'
    
    const courrierData = ref()
    const showDetail = ref(false)

    const getSelectedCourrier =(e)=>{
        courrierData.value = e
        showDetail.value = true
    }


</script>
