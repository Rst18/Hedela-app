

<template>
    <Head title="Notes techniques"/>

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Mes Notes Techniques (Internes)</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <NoteTechniqueListInterne @selectedNote="getSeletedNote" v-if="!showDetailsNote"/>
                <DetailsNoteTechniqueInterne @closeMe="showDetailsNote = false" :note="currentNote" v-if="showDetailsNote"/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>

    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref,onMounted } from 'vue'
    import NoteTechniqueListInterne from '@/Components/NoteTechniqueInterne/NoteTechniqueListInterne.vue'
    import DetailsNoteTechniqueInterne from '@/Components/NoteTechniqueInterne/DetailsNoteTechniqueInterne.vue'

        const currentNote = ref()

        const showDetailsNote = ref(false)

        const getSeletedNote = (e)=>{
            currentNote.value = e
            showDetailsNote.value = true
        }
</script>
