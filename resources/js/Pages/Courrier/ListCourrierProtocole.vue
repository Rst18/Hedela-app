

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Liste Courriers Protocole</h2>
        </template>

        <div v-if="!update" class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">

          <ListCourriers v-if="!showDetail" @selectedCourrier="getSelectedCourrier"/>
           <DetailsCourrierProtocole v-else :courrier="courrierData" @courrier="getCurrentCourrier" @closeMe="showDetail = !showDetail" />
           
        </div>
        <div v-else class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Formulaire action="update" @updated="updatedCourrier" @hideMe="update = false" :courrier/>
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
import DetailsCourrierProtocole from '@/Components/Courrier/DetailsCourrierProtocole.vue'
    const props = defineProps({
        typeCourriers:Object,
        services:Object,
    })
    const courrierData = ref()
    const courrier = ref({})
    const showDetail = ref(false)
    const update = ref(false)

    const getCurrentCourrier = (e)=>{
        
        courrier.value = e
        update.value = true
    }
    const updatedCourrier = ()=>{
        update.value = false
        showDetail.value = false
    }
    const getSelectedCourrier =(e)=>{
        courrierData.value = e
        showDetail.value = true
    }


</script>
