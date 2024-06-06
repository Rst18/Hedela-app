

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
                                
                                <Fwb-button @click="createDocument = !createDocument">
                                    {{ createDocument ? 'Liste des document':'Nouveau Document' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <ListDocuments :documents v-show="!createDocument" />
                                <Formulaire action="add" @newAdded="refreshList" :document v-if="createDocument"/>
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

    const refreshList = (e)=>{
        documenstData.value.push(e)
        createDocument.value = false
    }
    onMounted(()=>{
        documenstData.value = props.documents
    })

</script>
