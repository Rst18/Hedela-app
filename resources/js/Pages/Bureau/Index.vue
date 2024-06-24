

<template>
    <Head title="Bureau" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bureau</h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Creation Bureau">
                        <div class="py-4">
                            <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createBureau == 0 ? createBureau = 1 : createBureau = 0">
                               {{ createBureau == 0 ? " Créer un Bureau":'Liste des bureaux' }}
                            </Fwb-button>
                        </div>
                        <div>
                            <ListBureau  v-if="createBureau == 0" @update="getCurrentBureau" />
                            <BureauForm :batiments :bureau action="add" @newAdded="createBureau = 0"  v-if="createBureau == 1"/>
                            <BureauForm :batiments :bureau action="update" @newAdded="createBureau = 0"  v-if="createBureau == 2"/>
                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="Attribution Bureau ">
                       <ListOfUserWithBureau :users :bureau="bureaux"/>
                    </fwb-tab>
                   
                </fwb-tabs>
               
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import BureauForm from '@/Components/Bureau/BureauForm.vue'
    import ListBureau from '@/Components/Bureau/ListBureau.vue'
    import {ref,onMounted} from 'vue'
    import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
    import ListOfUserWithBureau from '@/Components/Bureau/ListOfUserWithBureau.vue'

        const props = defineProps({
            batiments:Object,
            bureaux:Object,
            users:Object,
        })

        const activeTab = ref('first')
        const createBureau = ref(0)
        const bureau = ref({})
        const getCurrentBureau = (e)=>{
            bureau.value = e
            createBureau.value = 2
        }


</script>
