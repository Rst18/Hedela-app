

<template>
    <Head title="Audiences" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Liste des mes audiences</h2>
        </template>

        <div class="py-14 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <ListAudience path="../../../audience/myList" @new="showDetails = !showDetails"   :audience v-if="!showDetails" @selectedAudience="get_selected_audience"/>
            <DetailsAudience @closeMe="showDetails = false"   :audience="currentAudience" v-if="showDetails" />
            
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListAudience from '@/Components/Audience/ListAudience.vue'
import DetailsAudience from '@/Components/Audience/DetailsAudience.vue'
    const props = defineProps({
        users:Object
    })
    const audience = ref({})
    const currentAudience = ref()
    const showDetails = ref(false)

    const get_selected_audience = (e)=>{
        currentAudience.value = e
        showDetails.value = true
    }

</script>
