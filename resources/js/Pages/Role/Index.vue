

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
                                
                                <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="createUser = !createUser">
                                    {{ createUser ? 'Liste des utilisateurs':'Nouveau groupe' }}
                                </Fwb-button>
                            </div>
                            <div>
                                <ListRoles :roles v-show="!createUser" />
                                <Formulaire action="add" @newAdded="refreshList" :role="rolesData" v-if="createUser"/>
                            </div>

                        </div>
                    </fwb-tab>
                    <fwb-tab name="second" title="Affectation utilisateurs Group">
                        <ListUsersWithRoles :roles :users/>
                    </fwb-tab>
                    <fwb-tab name="third" title="Third">
                    Lorem ipsum dolor...
                    </fwb-tab>
                    <fwb-tab name="fourth" title="Fourth" disabled>
                    Lorem ipsum dolor...
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
        users:Object
    })
    const rolesData = ref([])
    const role = ref({})
    const createUser = ref(false)

    const refreshList = (e)=>{
        rolesData.value.push(e)
        createUser.value = false
    }
    onMounted(()=>{
        rolesData.value = props.roles
    })

</script>
