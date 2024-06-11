<template>
    <div class="grid grid-cols-1 p-4">
        <div class="py-2">
            <span class="font-semibold text-gray-400">Destinataire :</span>
            <p>{{ note.destinataire }}, {{ note.courrier.email }}, {{ note.courrier.phone }}</p>
        </div>
        <div class="py-2">
            <span class="font-semibold text-gray-400">Copie a :</span>
            <p>{{ note.copiea }}</p>
        </div>
        <div class="py-2">
            <span class="font-semibold text-gray-400">Signataire : </span>
            <p>{{ note.signataire }}</p>
        </div>
        <div class="py-2">
            <span class="font-semibold text-gray-400">Objet : </span>
            <p>{{ note.objet }}</p>
        </div>
        
        <div class="py-2">
            <span class="font-semibold text-gray-400">Lettre : </span>
            <p v-html="note.lettre"></p>
        </div>
        <div class="py-2">
            <Fwb-button>
                Imprimer
            </Fwb-button>
        </div>

    </div>
</template>
<script setup>

import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'
const props = defineProps({
    note:Object
})
</script>