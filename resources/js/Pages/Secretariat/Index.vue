

<template>
    <Head title="NOte technique"/>

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl  text-gray-800 leading-tight">Secretariat</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ListNoteSecretariat @selectedNote="getSeletedNote" v-show="!showDetailsNote"/>
            </div>
        </div>
    </SideBarLayout>
</template>
<script setup>

    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { ref,onMounted } from 'vue'
    import ListNoteSecretariat from '@/Components/Secretariat/ListNoteSecretariat.vue'
    // import DetailsNoteTechnique from '@/Components/NoteTechnique/DetailsNoteTechnique.vue'

        const currentNote = ref()

        const showDetailsNote = ref(false)

        const getSeletedNote = (e)=>{
            currentNote.value = e
            showDetailsNote.value = true
        }
</script>
