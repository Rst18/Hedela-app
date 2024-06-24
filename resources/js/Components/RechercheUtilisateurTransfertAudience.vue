<template>
    
    <div class="absolute top-32 shadow-md px-4 py-2  right-5 border h-4/5 w-96 z-10 flex flex-col overflow-auto bg-gray-50 ">
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
                :audience_id
                @transfert="transfered"
                />  
            
        </div>
        
    </div>
  
</template>

<script setup>
    import {ref,onMounted} from 'vue'
    import { FwbInput,FwbButton } from 'flowbite-vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import UserCardRecherche from './UserCardRechercheTransfert.vue'
    
    const props = defineProps({
        path:String,
        audience_id:Number
    })

    const emit = defineEmits(
        ['transfert']
    )

    const { axios_get,axios_post } = useAxios()

    const users = ref([ ])

    const transfered = ()=>{
        emit('transfert')
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