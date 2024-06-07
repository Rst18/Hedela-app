

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Courriers</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" v-show="!detailsCourrier">

                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Enregistrement  des courrier">
                        <div class="">
                            <div class="">
                                
                                <Fwb-button @click="createCourrier = !createCourrier">
                                    {{ createCourrier ? 'Liste des courriers':'Nouveau Courrier' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <Formulaire
                                    v-if="createCourrier"
                                    action="add"
                                    @newAdded="refreshList" 
                                    :courrier
                                    :services
                                    :typeCourriers
                                   
                                 />
                                 <ListCourriers  @selectedCourrier="getSelectedCourrier"/>
                            </div>

                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="...">
                    </fwb-tab>  
                </fwb-tabs>
               
               
                

               
            </div>
            <div v-if="detailsCourrier">
                    <DetailsCourrier :courrier="currentCourrier" />

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
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListCourriers from '@/Components/Courrier/ListCourriers.vue'
import DetailsCourrier from '@/Components/Courrier/DetailsCourrier.vue'
    const activeTab = ref('first')
    const props = defineProps({
        typeCourriers:Object,
        services:Object
    })
    const courrierData = ref([])
    const courrier = ref({})
    const createCourrier = ref(false)
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
        courrierData.value = props.roles
    })

</script>
