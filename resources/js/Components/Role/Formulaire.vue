<template>
    <div class=" mt-2 p-4 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Administateur"
                label="Entrer le nom du Role ( groupe utilisateur)"
            />
            <div class="text-red-500 text-xs py-1" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div class="mt-4">
           <ToggleInput @getValue="getToggleValue">
            Solicitable ?
           </ToggleInput>
            <div class="text-red-500 text-xs py-1" v-if="errors.solicitable">
                {{ errors.solicitable[0]}}
            </div>
        </div>
        <div>
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
            role:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.role.name,
        solicitable:props.role.solicitable
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('../role/add',form.value).then(({data})=>{

                if (data.type ==='success') {

                    emit('newAdded',data.new)
                }
            }).catch((error)=>{
                if(error.response.status === 422){
                    errors.value = error.response.data.errors
                }
            })

        }else if(props.action === 'update'){
            axios_post_simple('../role/'+props.role.id+'/update',form.value).then(({data})=>{

                if (data.type ==='success') {
                    emit('newAdded',data.new) 
                }
            }).catch((error)=>{
                if(error.response.status === 422){
                    errors.value = error.response.data.errors
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