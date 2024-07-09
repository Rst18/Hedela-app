<template>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9  p-8 ">
            <AideMemoire v-if="addAideMemoire" :reunion/>
            <div>
                <div>
                    <div>
                        <span class="block py-2 font-semibold">Code : </span>
                        <span>{{ reunion.id }}</span>

                    </div>
                    <div>
                        <span class="block py-2 font-semibold">Description : </span>
                        <p class="text-sm">{{ reunion.description }}</p>

                    </div>
                    <div>
                        <span class="font-semibold">Liens</span>
                        <div class="grid grid-cols-1 gap-2 text-sm">
                            <a :href="reunion.lien_youtube"> Lien youtube</a>
                            <a :href="reunion.lien_zoom"> Lien zoom</a>
                        </div>
                    </div>
                </div>
                <div class="border-t py-2">
                    <span class="font-semibold text-gray-700 text-2xl  py-6">Points à l'ordre du jour</span>

                    <div v-for="(o,index) in reunion.ordres_du_jour" :key="o.id" class="mb-2 ml-2">
                        <span class="py-1 font-semibold">{{ index + 1 }} : {{ o.name }}</span>
                        <p>{{ o.description }}</p>

                        <div class="grid grid-cols-1 ml-6">
                            <span class="text-gray-500 py-1">Annexes ({{ o.annexes ?  o.annexes.length : 0  }})</span>
                            <a v-for="annexe in o.annexes" :key="annexe.id" href="" class="underline">{{ annexe.name }}</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-3 grid grid-cols-1  gap-4 p-4 h-1/2 shadow-md">
            <div>
                <span class=" py-2 text-gray-500 font-semisolid">Liste des orateurs ({{ reunion.orateurs.length }})</span>
            
                <div class="grid grid-cols-1 gap-2 text-sm py-2">
                    <span v-for="o in reunion.orateurs" class="col-span-1">
                        {{ o.name }}
                    </span>
                </div>

            </div>
            <div class="border-t grid grid-cols-1">
                <span class="text-gray-500  font-semibold">Interractions</span>
                <div class=" grid grid-cols-1 gap-2 text-sm">
                    <button class="border px-2 rounded-full cursor-pointer">
                        Lever la main
                    </button>
                    <button @click="addAideMemoire = true" class=" border px-2 rounded-full  cursor-pointer">
                        Envoyer Aide memoire
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>

    import AideMemoire from './AideMemoire.vue';
    import {ref} from 'vue'
import OrdreJour from './OrdreJour.vue';
        const props = defineProps({
            reunion:Object
        })

        const addAideMemoire = ref(false)
</script>