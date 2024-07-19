<template>
    <div class="p-4 grid grid-cols-1 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Nom du Batiment"
                label="Entrer le nom du Batiment"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.niveaux"
                placeholder="6"
                label="Nombre de niveau"
                type="number"
            />
            <div class="text-red-500" v-if="errors.niveaux">
                {{ errors.niveaux[0]}}
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
            batiment:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded','updated'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.batiment.name,
        niveaux:props.batiment.niveaux,
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('../batiment/add',form.value).then(({data})=>{
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('../batiment/'+props.batiment.id+'/update',form.value).then(({data})=>{
                
                emit('updated',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
    }

   
    
</script>