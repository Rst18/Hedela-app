<template>
    <div>
        <div>
            <div>
                <span class="block py-2 font-semibold">Code : </span>
                <span class="text-gray-700">{{ reunion.id }}</span>

            </div>
            <div>
                <span class="block py-2 font-semibold">Description : </span>
                <p class="text-sm text-gray-700">{{ reunion.description }}</p>

            </div>
            <div class="py-2">
                <span class="font-semibold py-2">Liens</span>
                <div class="grid grid-cols-1 gap-2 text-sm text-gray-700">
                    <a :href="reunion.lien_youtube"> Lien youtube</a>
                    <a :href="reunion.lien_zoom"> Lien zoom</a>
                </div>
            </div>
        </div>
        <div class="border-t py-2">
            <span class="font-semibold text-gray-700 text-2xl  py-6">Points à l'ordre du jour</span>

            <div v-for="(o,index) in reunion.ordres_du_jour" :key="o.id" class="mb-2 ml-2 text-gray-700">
                <span class="py-1 font-semibold text-sm">{{ index + 1 }} : {{ o.name }}</span>
                <p class="ml-4 text-xs">{{ o.description }}</p>

                <div class="grid grid-cols-1 ml-6">
                    <span class="text-gray-700 py-1 text-sm font-semibold">Annexes ({{ o.annexes ?  o.annexes.length : 0  }})</span>
                    <a v-for="annexe in o.annexes" :key="annexe.id"  class="underline text-xs"  :href="'../../download/'+ annexe.filePath.replaceAll('/','++')" target="_blank">{{ annexe.name }}</a>
                </div>


            </div>
        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        reunion:Object
    })
</script>