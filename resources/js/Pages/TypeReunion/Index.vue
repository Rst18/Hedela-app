

<template>
    <Head title="Type reunion" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Type reunions</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createTypeReunion = !createTypeReunion">
                        Créer un type de reunion
                    </Fwb-button>
                </div>
                <div v-if="!updateTypeReunion">
                    <ListTypeReunion @selectedItem="getSelectedItem"  v-if="!createTypeReunion" />
                    <FormCreate :type_reunion={} action="add" @newAdded="createTypeReunion = false"  v-if="createTypeReunion"/>
                </div>
                <div v-else>
                    <FormCreate :type_reunion action="update" @updated="updateTypeReunion = false" />
                </div>

            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import FormCreate from '@/Components/TypeReunion/FormCreate.vue'
    import ListTypeReunion from '@/Components/TypeReunion/ListTypeReunion.vue'
    import {ref,onMounted} from 'vue'
    import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'

        const createTypeReunion = ref(false)
        const updateTypeReunion = ref(false)

        const type_reunion = ref({})
        const getSelectedItem = (e)=>{
            type_reunion.value = e
            updateTypeReunion.value = true
        }


</script>
