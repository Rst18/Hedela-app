

<template>
    <Head title="Audiences" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Soliciter une audience</h2>
        </template>

        <div class="py-14 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <AudienceForm :users option="add" @added="showComponent=1" :audience/>
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import AudienceForm from '@/Components/Audience/AudienceForm.vue'
import {ref,onMounted} from 'vue'
import { FwbTab, FwbTabs,FwbButton } from 'flowbite-vue'
import ListAudience from '@/Components/Audience/ListAudience.vue'
import DetailsAudience from '@/Components/Audience/DetailsAudience.vue'
    const props = defineProps({
        users:Object
    })
    const audience = ref({})
    const currentAudience = ref()
    const showComponent = ref(1)

    const get_selected_audience = (e)=>{
        currentAudience.value = e
        showComponent.value = 3
    }

</script>
