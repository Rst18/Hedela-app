

<template>
    <Head title="Bureau" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Menu</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="py-4">
                    <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createMenu = !createMenu">
                        Créer un Menu
                    </Fwb-button>
                </div>
                <div>
                    <ListMenu  v-if="!createMenu" />
                    <MenuForm  :menu action="add" @newAdded="createMenu = false"  v-if="createMenu"/>
                </div>
               
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

        const createMenu = ref(false)
        const menu = ref({})


</script>
