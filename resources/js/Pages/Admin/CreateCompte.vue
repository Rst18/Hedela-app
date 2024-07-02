

<template>
    <Head title="Roles" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestion compte utilisateur</h2>
        </template>

        <div class="py-12">
            <div class="grid grid-cols-1">
                <CreateCompte/>
            </div>
            
              
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import Recherche from '@/Components/Recherche/Recherche.vue'
import useAxios from '@/ComponentsServices/axios.js'
import CreateCompte from '@/Components/Admin/CreateCompte.vue'
    const {axios_post_simple} = useAxios();

   
</script>
