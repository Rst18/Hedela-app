<template>
    <div >
        <div>
            <span class=" py-2 text-gray-700 font-semisolid">Liste des orateurs ({{ reunion.orateurs.length }})</span>
        
            <div class="grid grid-cols-1 gap-2 text-sm py-2">
                <span v-for="o in reunion.orateurs" class="col-span-1">
                    {{ o.name }}
                </span>
            </div>

        </div>
        <div>
            <span class=" py-2 text-gray-700 font-semisolid">Liste des intervenants ({{ reunion.demande_parole.length }})</span>
        
            <div class="grid grid-cols-1 gap-2 text-sm py-2">
                <span v-for="o in reunion.demande_parole" class="col-span-1">
                    {{ o.name }}
                </span>
            </div>

        </div>
        <div class="border-t grid grid-cols-1">

            <span class="text-gray-700  font-semibold">Interractions</span>

            <div v-if="is_Admin ===  1" class=" grid grid-cols-1 gap-2 text-sm py-4">

                <RButton > Demandes Parole ({{ reunion.demande_parole.length }}) </RButton>
                <RButton >Lever la main </RButton>
                <RButton @click="showAidememoire" > Aides memoire ({{ reunion.aides_memoire.length }}) </RButton>
               
            </div>
            <div v-else class=" grid grid-cols-1 gap-2 text-sm py-4">
                <RButton @click="demanderParole" > Demande Parole </RButton>
                <RButton @click="" > Lever la main</RButton>
                <RButton > Envoyer Aide memoire  </RButton>      
            </div>


        </div>
    </div>
</template>
<script setup>
 import RButton from './RButton.vue';
    const props = defineProps({
        reunion:Object,
        is_Admin:Number
    })
    const emit = defineEmits(['showAidesMemoire'])

    const showAidememoire = ()=>emit('showAidesMemoire')
</script>