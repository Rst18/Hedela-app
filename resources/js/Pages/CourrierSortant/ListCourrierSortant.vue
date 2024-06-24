

<template>
    <Head title="Courriers Sortant" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Liste Courriers sortant</h2>
        </template>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <ListCourrierSortant @selectedCourrier="get_selected_courrier"  v-if="!selectedCourrier"/>
            <Formulaire v-if="selectedCourrier" :courrier_sortant action="update" @newUpdated="selectedCourrier = false"/>

        </div>

    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import ListCourrierSortant from '@/Components/CourrierSortant/ListCourrierSortant.vue'
import Formulaire from '@/Components/CourrierSortant/Formulaire.vue'
import {ref,onMounted} from 'vue'
import { FwbButton } from 'flowbite-vue'

    const courrier_sortant = ref({ })
    const selectedCourrier = ref(false)

    const get_selected_courrier =(e)=>{
        courrier_sortant.value = e
        selectedCourrier.value = true

    }

</script>
