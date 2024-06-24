

<template>
    <Head title="Bureau" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestion des Menus</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Creation Menu">
                        <div class="py-4">
                            <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click=" createMenu == 1 ? createMenu = 0 : createMenu = 1">
                               {{ createMenu == 0 ? ' Créer un Menu' : 'Liste des menus' }}
                            </Fwb-button>
                        </div>
                        <div>
                            <ListMenu  v-if="createMenu == 0" @update="getCurrentMenu" />
                            <MenuForm  :menu action="add" @newAdded="createMenu = 0 "  v-if="createMenu == 1"/>
                            <MenuForm  :menu action="update" @newAdded="createMenu = 0 "  v-if="createMenu == 2"/>
                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="Attribution Menu ">
                        <ListOfUserWithMenu :users :menus/>
                    </fwb-tab>
                </fwb-tabs>
               
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import MenuForm from '@/Components/Menu/MenuForm.vue'
    import ListMenu from '@/Components/Menu/ListMenu.vue'
    import {ref,onMounted} from 'vue'
    import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
    import ListOfUserWithMenu from '@/Components/Menu/ListOfUserWithMenu.vue'

        const props = defineProps({
            users:Object,
            menus:Object
        })
        const activeTab = ref('first')
        const createMenu = ref(0)
        const menu = ref({})

        const getCurrentMenu = (e)=>{
            menu.value = e
            createMenu.value = 2
        }


</script>
