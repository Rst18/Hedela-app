

<template>
    <Head title="Batiments" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Batiments</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createBatiment = !createBatiment">
                        Créer un Batiment
                    </Fwb-button>
                </div>
                <div>
                    <ListBatiment  v-if="!createBatiment" />
                    <BatimentForm :batiment action="add" @newAdded="createBatiment = false"  v-if="createBatiment"/>
                </div>

            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import BatimentForm from '@/Components/Batiment/BatimentForm.vue'
    import ListBatiment from '@/Components/Batiment/ListBatiment.vue'
    import {ref,onMounted} from 'vue'
    import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'

        const createBatiment = ref(false)

    const batiment = ref({})


</script>
