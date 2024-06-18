<template>
    <div class="p-4 grid grid-cols-1 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Ajouter Utilisateur"
                label="Entrer le nom du menu"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.path"
                placeholder="user.insert"
                label="Route"
              
            />
            <div class="text-red-500" v-if="errors.path">
                {{ errors.path[0]}}
            </div>
        </div>
       
        <div class="py-2">
            <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="submitForm">
                Enregistrer
            </Fwb-button>
        </div>
        
    </div>
</template>
<script setup >
import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import {ref} from 'vue'
import ToggleInput from '@/Components/ToggleInput.vue'
    const props = defineProps(
        {
            menu:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.menu.name,
        path:props.menu.path,
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('../menu/add',form.value).then(({data})=>{
                if (data.type ==='success') {
                    emit('newAdded',data.new)
                    
                }
                console.log(data);
            }).catch((error)=>{

                if (error.response.status == 422) {

                    errors.value = error.response.data.errors
                }
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('../menu/'+props.menu.id+'/update',form.value).then(({data})=>{
                //console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                if (error.response.status == 422) {

                    errors.value = error.response.data.errors
                }
                console.log(error.response)
            })
        }
        else{
            
        }
    }

   
    
</script>