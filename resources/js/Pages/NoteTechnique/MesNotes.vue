

<template>
    <Head title="NOte technique"/>

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Mes Notes Techniques</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <NoteTechniqueList @selectedNote="getSeletedNote" v-if="!showDetailsNote"/>
                <DetailsNoteTechnique @closeMe="showDetailsNote = false" :note="currentNote" v-if="showDetailsNote"/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>

    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref,onMounted } from 'vue'
    import NoteTechniqueList from '@/Components/NoteTechnique/NoteTechniqueList.vue'
    import DetailsNoteTechnique from '@/Components/NoteTechnique/DetailsNoteTechnique.vue'

        const currentNote = ref()

        const showDetailsNote = ref(false)

        const getSeletedNote = (e)=>{
            currentNote.value = e
            showDetailsNote.value = true
        }
</script>
