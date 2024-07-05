

<template>
    <Head title="Courriers" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Enregistrement Courriers</h2>
        </template>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <Formulaire
                action="add"
                :courrier
                :services
                :typeCourriers
                
                />
        </div>

    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import Formulaire from '@/Components/Courrier/Formulaire.vue'
import {ref,onMounted} from 'vue'

    const props = defineProps({
        
        typeCourriers:Object,
        services:Object,
    })
    const courrierData = ref([])
    const courrier = ref({
    })

    onMounted(()=>{
        courrierData.value = props.roles
    })

</script>
