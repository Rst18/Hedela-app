

<template>
    <Head title="Type Courrier" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Type Courrier</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Type Courrier">
                        <div class="">
                            <div class="">
                                
                                <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createTypeCourrier = !createTypeCourrier">
                                    {{ createTypeCourrier ? 'Liste des Type de courrier':'Nouveau Type de courrier' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <ListTypeCourriers  v-if="!createTypeCourrier" />
                                <Formulaire action="add" @newAdded="refreshList" :typeCourrier v-if="createTypeCourrier"/>
                            </div>

                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="...">
                    </fwb-tab>
                </fwb-tabs>
                

               
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/TypeCourrier/Formulaire.vue'
import ListTypeCourriers from '@/Components/TypeCourrier/ListTypeCourriers.vue'
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'

    const activeTab = ref('first')
    const props = defineProps({
        typeCourriers:Object,
    })
    const typeCourriersData = ref([])
    const typeCourrier = ref({})
    const createTypeCourrier = ref(false)

    const refreshList = (e)=>{
        typeCourriersData.value.push(e)
        createTypeCourrier.value = false
    }
    onMounted(()=>{
        typeCourriersData.value = props.typeCourriers
    })

</script>
