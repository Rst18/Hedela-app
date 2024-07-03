

<template>
    <Head title="Notes techniques"/>

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Initier une note Technique</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <NoteTechniqueInterneForm action="add" :note="{}"/>

            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>

    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref,onMounted } from 'vue'
    import NoteTechniqueInterneForm from '@/Components/NoteTechniqueInterne/NoteTechniqueInterneForm.vue'

        const currentNote = ref()

        const showDetailsNote = ref(false)

        const getSeletedNote = (e)=>{
            currentNote.value = e
            showDetailsNote.value = true
        }
</script>
