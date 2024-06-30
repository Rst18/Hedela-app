

<template>
    <Head title="Roles" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Role</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                    <fwb-tab name="first" title="Creation des groupes">
                        <div class="">
                            <div class="">
                                
                                <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createRole = !createRole">
                                    {{ createRole ? 'Liste des utilisateurs':'Nouveau groupe' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <ListRoles  v-if="createRole == 0" @update="getCurentRole" />
                                <Formulaire action="add" @newAdded="createRole = 0" :role="rolesData" v-if="createRole == 1"/>
                                <Formulaire action="update" @newAdded="createRole = 0"  :role v-if="createRole == 2"/>
                            </div>

                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="Affectation utilisateurs Group">
                        <ListUsersWithRoles :roles :users/>
                    </fwb-tab>
                </fwb-tabs>
                

               
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/Role/Formulaire.vue'
import ListRoles from '@/Components/Role/ListRoles.vue'
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListUsersWithRoles from '@/Components/Role/ListUsersWithRoles.vue';

    const activeTab = ref('first')
    const props = defineProps({
        roles:Object,
        users:Object,
    })
    const rolesData = ref([])
    const role = ref({})
    const createRole = ref(0)

    const refreshList = (e)=>{
        rolesData.value.push(e)
        createRole.value = false
    }
    const getCurentRole = (e)=>{
        role.value = e
        createRole.value = 2
    }
    onMounted(()=>{
        rolesData.value = props.roles
    })

</script>
