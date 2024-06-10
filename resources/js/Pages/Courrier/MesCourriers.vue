

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courriers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

               
                <div v-show="!detailsCourrier">
                    <ListCourriers   @selectedCourrier="getSelectedCourrier"/>
                </div>
               
               
                <div v-if="detailsCourrier">
                    <DetailsCourrier :courrier="currentCourrier" />
                </div>
     
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/Courrier/Formulaire.vue'
import ListRoles from '@/Components/Role/ListRoles.vue'
import {ref,onMounted} from 'vue'
import ListCourriers from '@/Components/Courrier/ListMesCourriers.vue'
import DetailsCourrier from '@/Components/Courrier/DetailsCourrier.vue'
    const activeTab = ref('first')

    const courrierData = ref([])
    const courrier = ref({})
    const currentCourrier = ref()
    const detailsCourrier = ref(false)

    const getSelectedCourrier = (e)=>{
        
        currentCourrier.value = e
      detailsCourrier.value = true
    }

    const refreshList = (e)=>{
        courrierData.value.push(e)
        createCourrier.value = false
    }
    onMounted(()=>{
    })

</script>
