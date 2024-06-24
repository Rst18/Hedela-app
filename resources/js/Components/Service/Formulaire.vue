<template>
    <div class="p-4 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.code"
                placeholder="SCRR"
                label="Entrer le code du Service"
            />
            <div class="text-red-500 text-xs py-1" v-if="errors.code">
                {{ errors.code[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Courrier"
                label="Entrer le nom du Service"
            />
            <div class="text-red-500 text-xs py-1" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
       
        <div class="mt-4">
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
            service:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.service.name,
        code:props.service.code
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('../service/add',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                if(error.response.status === 422){
                    errors.value = error.response.data.errors
               
                }
            })

        }else if(props.action === 'update'){
            axios_post_simple('../service/'+props.service.id+'/update',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                if(error.response.status === 422){
                    errors.value = error.response.data.errors
                console.log(error.response.data.errors)
                }
            })
        }
        else{
            
        }
    }

    const getToggleValue = (e)=>{
        form.value.solicitable = e
    }


    
</script>