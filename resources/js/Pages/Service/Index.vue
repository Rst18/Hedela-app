

<template>
    <Head title="Service" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Services</h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Services">
                        <div class="">
                            <div class="">
                                
                                <Fwb-button class="bg-gray-800 hover:bg-gray-600"@click="createService == 0 ? createService = 1 :createService=0">
                                    {{ createService ? 'Liste des service':'Nouveau service' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <ListServices @update="getCurrentService" :services v-if="createService == 0" />
                                <Formulaire action="add" @newAdded="createService = 0" :service v-if="createService == 1"/>
                                <Formulaire action="update" @newAdded="createService = 0" :service v-if="createService == 2"/>
                            </div>

                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="Affectation des documents aux services">
                        <ListServicesWithDocuments :services :documents/>
                    </fwb-tab>
                </fwb-tabs>
                

               
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/Service/Formulaire.vue'
import ListServices from '@/Components/Service/ListServices.vue'
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListServicesWithDocuments from '@/Components/Service/ListServicesWithDocuments.vue';

    const activeTab = ref('first')
    const props = defineProps({
        documents:Object,
        services:Object
    })
    const servicesData = ref([])
    const service = ref({})
    const createService = ref(0)

    const refreshList = (e)=>{
        servicesData.value.push(e)
        createService.value = 0
    }

    const getCurrentService = (e)=>{
       service.value = e 
       createService.value = 2
    }
    onMounted(()=>{
        servicesData.value = props.roles
    })

</script>
