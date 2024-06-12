<template>
    <div class="grid grid-cols-3">
        <span @click="close" class="col-span-3 w-fit border rounded-full py-1 px-2 text-xs font-semibold bg-red-600 text-slate-200 cursor-pointer">Retour</span>
        <div class="col-span-2">

            <RendezvousForm  

                option="update"
                :audience_id 
                :rendezvous />

        </div>
        <div class="col-span-1 text-xs border-l px-2">
            <div class="flex flex-col space-y-1">
                <span >Participants ({{ users.length }})</span>
              
            </div>
            <div class="mt-4">
                <div class="grid grid-cols-12 py-1 text-sm font-semibold text-gray-800 border px-2 rounded mb-2" v-for="user in users">
                   <div class="col-span-2 rounded-full  h-fit w-fit flex justify-center items-center">
                        <img  :src="profil +user.name" class="w-12 h-12 rounded-full bg-gray-100" alt="Avatar">
                                
                   </div>
                   <div class="col-span-10">
                       <span>{{ user.name }}</span>
                       <div class="text-xs grid grid-cols-2 py-1 px-4 ">
                           <span class="col-span-1 w-fit px-2 rounded-full bg-slate-100 text-gray-400 font-bold " v-for="role in user.roles" :key="role.id">{{ role.name }}</span>
   
                       </div>
                   </div>
                </div>

            </div>
            <div class="mt-4">
                <span @click="ajouterParticipant = true" class=" w-fit border py-1 px-2 rounded-full cursor-pointer bg-slate-100 text-slate-700 font-semibold">Ajouter</span>
            </div>


        </div>
        <RechercheUtilisateur v-if="ajouterParticipant" @newUser="refleshParticipant" :rendezvous path="../user/search"/>
    </div>
</template>
<script setup>

import RendezvousForm from './RendezvousForm.vue'
import UserCardRecherche from '@/Components/UserCardRecherche.vue'
import RechercheUtilisateur from '@/Components/RechercheUtilisateur.vue'
import {ref} from 'vue'
    const props = defineProps({
        audience_id:Number,
        rendezvous:Object
    })
    const emit = defineEmits(['closeMe'])

    const close = ()=>emit('closeMe')
    
    const profil = ref('https://ui-avatars.com/api/?name=')
    const ajouterParticipant = ref(false)
    const users = ref(props.rendezvous.users)

    const refleshParticipant = (e)=>{
        users.value.push(e)
        ajouterParticipant.value = false
    }
   

</script>