<template>
    <div class="grid grid-cols-12">
        <div class="col-span-9">
            <AideMemoire v-if="addAideMemoire" :reunion/>
        </div>
        <div class="col-span-3 grid grid-cols-1 gap-4">
            <div>
                <span class=" py-2 text-gray-500 font-light">Liste des orateurs ({{ reunion.orateurs.length }})</span>
            
                <div class="grid grid-cols-1">
                    <span v-for="o in reunion.orateurs" class="col-span-1">
                        {{ o.name }}
                    </span>
                </div>

            </div>
            <div class="border-t grid grid-cols-1">
                <span class="py-2">Interractions</span>
                <div class=" grid grid-cols-1">
                    <span>
                        Lever la main
                    </span>
                    <span @click="addAideMemoire = true">
                        Envoyer Aide memoire
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>

    import AideMemoire from './AideMemoire.vue';
    import {ref} from 'vue'
        const props = defineProps({
            reunion:Object
        })

        const addAideMemoire = ref(false)
</script>