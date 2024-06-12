<template>
    
    <div class="absolute top-24 shadow-md px-4 py-2  right-5 border h-4/5 w-96 z-10 flex flex-col overflow-auto bg-gray-50 ">
        <div>
            <fwb-input
                placeholder="Ecrire le nom de l'utilisateur"
                label="Rechercher un Utilisateur"
                @keypress="cherch"
                
            />
        </div>
        <div  class="mt-2" >
            <UserCardRecherche
                v-for="user in users"
                :key="user.id"
                :user
                :rendezvous_id = "rendezvous.id"
                @userAdded="getUserAdded"
                />  
            
        </div>
        
    </div>
  
</template>

<script setup>
    import {ref,onMounted} from 'vue'
    import { FwbInput,FwbButton } from 'flowbite-vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import UserCardRecherche from './UserCardRecherche.vue'
    
    const props = defineProps({
        path:String,
        rendezvous:Object
    })

    const emit = defineEmits(
        ['newUser']
    )

    const { axios_get,axios_post } = useAxios()

    const users = ref([ ])

    const getUserAdded = (e)=>{
        emit('newUser',e)
    }



    
    const cherch = (e)=>{
        if (e.key === 'Enter') {

            rechercherRessource({
                'text':e.target.value,
                'path':props.path
              
            })
        }
    };
    // rechercher compte

    const rechercherRessource = (e) =>{
        
        if (e.text.length >= 3) {
            
            axios_post(e.path,{name:e.text}).then(({data})=>{ 
                console.log(data)
                users.value = data
            }).catch((error)=>{
                console.log(error)
            })
        }else alert('entrer un mot de plus de 2 caractères')
    }
</script>

<style lang="scss" scoped>

</style>