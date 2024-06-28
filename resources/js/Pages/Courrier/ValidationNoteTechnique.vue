

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Validation des notes techniques</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >

               
                <div v-if="!detailsCourrier">
                    <ListCourriers   @selectedCourrier="getSelectedCourrier"/>
                </div>
               
               
                <div v-if="detailsCourrier">
                    <DetailsCourrierNoteTechniqueAdmin @closeMe="detailsCourrier = !detailsCourrier" :courrier="currentCourrier" />
                </div>
     
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import ListCourriers from '@/Components/Courrier/ListCourrierValidation.vue'
import DetailsCourrierNoteTechniqueAdmin from '@/Components/Courrier/DetailsCourrierNoteTechniqueAdmin.vue'
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
