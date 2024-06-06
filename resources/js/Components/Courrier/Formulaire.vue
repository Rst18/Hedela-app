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
                v-model="form.objet"
                placeholder="Information"
                label="Objet (Motif)"
            />
            <div class="text-red-500" v-if="errors.objet">
                {{ errors.objet[0]}}
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
                label="Ficher"
                type="file"
                @change="getDocument"
            />
            <div class="text-red-500" v-if="errors.letter_file">
                {{ errors.letter_file[0]}}
            </div>
        </div>
        <div>
           <SelectComponent label="service" :options="services"  @selectedOption="getService">
                Choisir un service
           </SelectComponent>
            <div class="text-red-500" v-if="errors.service_id">
                {{ errors.service_id[0]}}
            </div>
        </div>
        <div>
           <SelectComponent label="typecourrier" :options="typeCourriers" @selectedOption="getTypeCourrier">
                Choisir le type de courrier
           </SelectComponent>
            <div class="text-red-500" v-if="errors.type_courrier_id">
                {{ errors.type_courrier_id[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.annexes"
                label="Nombre des annexes"
                disabled
            />
            <div class="text-red-500" v-if="errors.annexes">
                {{ errors.annexes[0]}}
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
import SelectComponent from '@/Components/SelectComponent.vue'
    const props = defineProps(
        {
            services:Object,
            typeCourriers:Object,
            courrier:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple,axios_post } = useAxios();

    const form = ref({
        number:props.courrier.number,
        sender:props.courrier.sender,
        objet:props.courrier.objet,
        email:props.courrier.email,
        phone:props.courrier.phone,
        letter_number:props.courrier.letter_number,
        annexes:props.courrier.annexes,
        letter_file:'',
        service_id:props.courrier.service_id,
        type_courrier_id:props.courrier.type_courrier_id,
    })
    const errors = ref([]); 

    const currentService = ref();

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post('courrier/add',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('courrier/'+props.service.id+'/update',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
    }

    const getService = (e)=>{
        currentService.value = props.services.filter((service)=>service.id === e)
        form.value.annexes = currentService.value[0].documents.length
        form.value.service_id = e
    }

    const getTypeCourrier = (e)=>{
        form.value.type_courrier_id = e
    }

    const getDocument =(e)=>{

        if(e.target.files[0].size > 5000000){

            alert('Le ficher est trop grand')
            e.target.value = ''
            return

        }else{

            
            form.value.letter_file = e.target.files[0]

        } 
    }  
</script>