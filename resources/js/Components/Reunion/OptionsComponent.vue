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

                <button  class="border py-1 px-2 rounded-full cursor-pointer">
                    Demandes Parole ({{ reunion.demande_parole.length }})
                </button>
                <button class="border py-1 px-2 rounded-full cursor-pointer">
                    Lever la main
                </button>
                <button @click="showAidememoire" class=" border py-1 px-2 rounded-full  cursor-pointer">
                    Aides memoire ({{ reunion.aides_memoire.length }})
                </button>

            </div>
            <div v-else class=" grid grid-cols-1 gap-2 text-sm">
                    <button @click="demanderParole" class="border px-2 rounded-full cursor-pointer">
                        Demande Parole
                    </button>
                    <button class="border px-2 rounded-full cursor-pointer">
                        Lever la main
                    </button>
                    <button @click="addAideMemoire = true" class=" border px-2 rounded-full  cursor-pointer">
                        Envoyer Aide memoire 
                    </button>
                </div>


        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        reunion:Object,
        is_Admin:Number
    })
    const emit = defineEmits(['showAidesMemoire'])

    const showAidememoire = ()=>emit('showAidesMemoire')
</script>