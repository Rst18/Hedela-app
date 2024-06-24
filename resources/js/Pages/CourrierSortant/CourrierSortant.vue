

<template>
    <Head title="Courriers Sortant" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Enregistrement Courriers sortant</h2>
        </template>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <Formulaire
                action="add"
                :courrier_sortant 
            />
        </div>

    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/CourrierSortant/Formulaire.vue'
import {ref,onMounted} from 'vue'
import { FwbButton } from 'flowbite-vue'

    const courrier_sortant = ref({ })

</script>
