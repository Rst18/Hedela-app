<template>
    <div >
        <div class="p-6 shadow-md rounded-md grid grid-cols-2 gap-4" v-if="!created_courrier">
            <div>
                <fwb-input
                    v-model="form.number"
                    placeholder="2024-0000001"
                    label="Numero Courrier"
                    disabled
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
                <fwb-file-input v-model="form.letter_file" label="Ajouter la lettre" />
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
                <Fwb-button class="bg-gray-800 hover:bg-slate-400" @click="submitForm">
                    Enregistrer
                </Fwb-button>
            </div>
        </div>
        <div v-if="created_courrier" class="p-6">
            <div v-if="currentService[0].documents">
                <span class="text-gray-700 font-semibold text-xl py-2 px-2  text-center">Ajouter les Annexes de du courrier</span>
                <div v-if="currentService" class="p-8 ">
                    <UploadAnnexes v-for="doc in currentService[0].documents" :key="doc.id"  url="annexe-courrier/add" :model_id="created_courrier.id" :name="doc.name"/>
                </div>
            </div>

            <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                    </svg>
                </span>
                <p class="text-center mt-4">Pas de fichiers annexes, l'enregistrment du courrier est finit!  </p>
            </div>
        </div>
        
    </div>
</template>
<script setup >
import { FwbInput,FwbButton,FwbFileInput ,FwbP } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import {ref,onMounted} from 'vue'
import SelectComponent from '@/Components/SelectComponent.vue'
import UploadAnnexes from '@/Components/UploadAnnexes.vue'

import Swal from 'sweetalert2';

    const props = defineProps(
        {
            services:Object,
            typeCourriers:Object,
            courrier:Object,
            action:String,
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple,axios_post,axios_get } = useAxios();

    const form = ref({
        number:props.courrier.number,
        sender:props.courrier.sender,
        objet:props.courrier.objet,
        email:props.courrier.email,
        phone:props.courrier.phone,
        letter_number:props.courrier.letter_number,
        annexes:props.courrier.annexes,
        letter_file:null,
        service_id:props.courrier.service_id,
        type_courrier_id:props.courrier.type_courrier_id,
    })

    const created_courrier = ref()
    const errors = ref({}); 
    
    const currentService = ref();

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post('courrier/add',form.value).then(({data})=>{
                Swal.fire(data.type,data.message,data.type)
                created_courrier.value = data.new
                emit('newAdded',data.new)
                form.value = {}
            }).catch((error)=>{

                if (error.response.status === 422) {

                    errors.value = error.response.data.erros
                    console.log(error.response.status)
                    
                }
            })

        }else if(props.action === 'update'){
            let id = +props.courrier.id
            axios_post_simple('courrier/'+id+'/update',form.value).then(({data})=>{
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
        console.log(currentService.value)
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

    onMounted(() => {

      axios_get('courrier/new-number').then(({data})=>{

        if (props.action === 'add') {

            form.value.number = data
        }
      })  
    })
</script>