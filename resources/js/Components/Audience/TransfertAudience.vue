<template>
    <div class="grid grid-cols-3">
        <span @click="close" class="col-span-3 w-fit border rounded-full py-1 px-2 text-xs font-semibold bg-red-600 text-slate-200 cursor-pointer">Retour</span>
        <div class="col-span-2 py-16 text-red-700">
           Une fois cette audience Transferee, elle n'apparaitra plus sur la liste de vos audiences
        </div>
        <RechercheUtilisateurTransfertAudience :audience_id  @transfert="close"    path="../user/search"/>
    </div>
</template>
<script setup>

import RendezvousForm from './RendezvousForm.vue'
import UserCardRecherche from '@/Components/UserCardRecherche.vue'
import RechercheUtilisateurTransfertAudience from '@/Components/RechercheUtilisateurTransfertAudience.vue'
import {ref} from 'vue'
    const props = defineProps({
        audience_id:Number,
    })
    const emit = defineEmits(['closeMe'])

    const close = ()=>emit('closeMe')
    
    const profil = ref('https://ui-avatars.com/api/?name=')
   
</script>