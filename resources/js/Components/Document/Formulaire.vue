<template>
    <div class="p-4 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Diplome"
                label="Entrer le nom du Document"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
       
        <div>
            <Fwb-button @click="submitForm">
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
            document:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.document.name,
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('document/add',form.value).then(({data})=>{
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('document/'+props.document.id+'/update',form.value).then(({data})=>{
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
    }

   
    
</script>