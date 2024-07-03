

<template>
    <Head title="Documents" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Documents</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Creation des documents">
                        <div class="">
                            <div class="">
                                
                                <Fwb-button class="bg-gray-800" @click="createDocument = !createDocument">
                                    {{ createDocument ? 'Liste des document':'Nouveau Document' }}
                                </Fwb-button>
                            </div>
                            <div v-if="!updateDoc">

                                <ListDocuments @update="updateDocument" :documents v-if="!createDocument" />

                                <Formulaire action="add" @newAdded="refreshList" :document="documenstData" v-if="createDocument"/>

                            </div>
                            <div v-else="updateDoc">
                                <Formulaire action="update" @hideMe="hideForm" :document />
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
import Formulaire from '@/Components/Document/Formulaire.vue'
import ListDocuments from '@/Components/Document/ListDocuments.vue'
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'

    const activeTab = ref('first')
    const props = defineProps({
        documents:Object
    })

    const documenstData = ref([])
    const document = ref({})
    const createDocument = ref(false)
    const updateDoc = ref(false)

    const refreshList = (e)=>{
        documenstData.value.push(e)
        createDocument.value = false
    }
    const updateDocument = (e)=>{
        document.value = e
        updateDoc.value = true
    }
    const hideForm = ()=>{
        createDocument.value = false 
        updateDoc.value = false 
    }

    onMounted(()=>{
        documenstData.value = props.documents
    })

</script>
