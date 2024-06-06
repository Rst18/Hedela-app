<template>
    <div class="p-4 shadow-md rounded-md grid grid-cols-2 gap-4">
        <div>
            <fwb-input
                v-model="form.number"
                placeholder="2024-0000001"
                label="Numero Courrier"
            />
            <div class="text-red-500" v-if="errors.number">
                {{ errors.number[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.sender"
                placeholder="Min.Developpement"
                label="Expediteur"
            />
            <div class="text-red-500" v-if="errors.sender">
                {{ errors.sender[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.email"
                placeholder="Min.Developpement@devrur.ac.cd"
                label="Email"
            />
            <div class="text-red-500" v-if="errors.email">
                {{ errors.email[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.phone"
                placeholder="243-975-476-177"
                label="Phone"
            />
            <div class="text-red-500" v-if="errors.phone">
                {{ errors.phone[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.letter_number"
                placeholder="Min-24-001"
                label="Numero de la lettre"
            />
            <div class="text-red-500" v-if="errors.letter_number">
                {{ errors.letter_number[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.letter_file"
                label="Ficher"
                type="file"
            />
            <div class="text-red-500" v-if="errors.letter_file">
                {{ errors.letter_file[0]}}
            </div>
        </div>
       
        <div class="mt-4">
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
            services:Object,
            typeCourriers:Object,
            courrier:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        number:props.courrier.number,
        sender:props.courrier.sender,
        email:props.courrier.email,
        phone:props.courrier.phone,
        letter_number:props.courrier.letter_number,
        annexes:props.courrier.annexes,
        letter_file:props.courrier.letter_file,
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('service/add',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('service/'+props.service.id+'/update',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
    }

    const getToggleValue = (e)=>{
        form.value.solicitable = e
    }


    
</script>