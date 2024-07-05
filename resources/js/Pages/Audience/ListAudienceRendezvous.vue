

<template>
    <Head title="Audiences" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Liste des mes audiences Acceptees</h2>
        </template>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <fwb-tabs v-model="activeTab" variant="underline" class="p-5">
                <fwb-tab name="first" title="Audiences acceptees">
                    <ListAudience path="../../audience/list-accept" @new="showDetails = !showDetails"    v-if="!showDetails" @selectedAudience="get_selected_audience"/>
                    <DetailsAudienceAccept @closeMe="showDetails = false"   :audience="currentAudience" v-if="showDetails" />
                </fwb-tab>
                <fwb-tab name="second" title="Couverture reunion">
                    <ListReunionCouverture/>
                </fwb-tab>
                
            </fwb-tabs>
            
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListAudience from '@/Components/Audience/ListAudience.vue'
import DetailsAudienceAccept from '@/Components/Audience/DetailsAudienceAccept.vue'
import ListReunionCouverture from '@/Components/Audience/ListReunionCouverture.vue'
  
    const currentAudience = ref()
    const showDetails = ref(false)
    
    const activeTab = ref('first')
    const get_selected_audience = (e)=>{
        currentAudience.value = e
        showDetails.value = true
    }

</script>
