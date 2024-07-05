<template>
    <div >
        <div class="p-6 shadow-md rounded-md grid grid-cols-1 md:grid-cols-1 gap-4 max-w-lg mx-auto" v-if="!created_courrier">
            <div>
                <fwb-input
                    v-model="form.number"
                    placeholder="2024-0000001"
                    label="Numero Courrier"
                    disabled
                />
                <div class="text-red-500 text-xs py-1 " v-if="errors.number">
                    {{ errors.number[0]}}
                </div>
            </div>
            <div>
                <fwb-input
                    v-model="form.requested"
                    placeholder="Expeditaire"
                    label="Expeditaire"
                />
                <div class="text-red-500 text-xs py-1" v-if="errors.requested">
                    {{ errors.requested[0]}}
                </div>
            </div>
            
            <div>
                <fwb-file-input  v-model="form.letter_file" label="Ajouter la lettre" />
                <div class="text-red-500 text-xs py-1" v-if="errors.letter_file">
                    {{ errors.letter_file[0]}}
                </div>
            </div>
            <div >
                <fwb-file-input v-model="form.accuse_reception_file" label="Ajouter Accusee de reception" />
                <div class="text-red-500 text-xs py-1" v-if="errors.accuse_reception_file">
                    {{ errors.accuse_reception_file[0]}}
                </div>
            </div>
            
        
            <div class="mt-4">
                <Fwb-button class="bg-gray-800 hover:bg-slate-400" @click="submitForm">
                    Enregistrer
                </Fwb-button>
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

    const props = defineProps({
        courrier_sortant:Object,
        note:Object,
        action:String,
    })

    const emit = defineEmits(['newAdded','newUpdated']);

    const { axios_post_simple,axios_post,axios_get } = useAxios();

    const form = ref({
        note_id:props.note ? props.note.id:'',
        courrier_id:props.courrier_sortant ? props.courrier_sortant.courrier_id : props.note.courrier_id,
        number:props.courrier_sortant ? props.courrier_sortant.number:'',
        requested:props.courrier_sortant ? props.courrier_sortant.requested :'',
        letter_file:null,
        accuse_reception_file:'',

    })
    
    const newNumber = ref()
    
    const created_courrier = ref()
    const errors = ref({}); 
    
    const currentService = ref();
    
    const submitForm = ()=>{
        errors.value = {}
        if (props.action === 'add') {

            axios_post('../courrier-sortant/add',form.value).then(({data})=>{

                if (data.type === 'success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{

                        created_courrier.value = data.new
                        emit('newAdded',data.new)
                        form.value = {}
                    })
                    
                }
            }).catch((error)=>{
                if (error.response.status === 422) {

                    errors.value = error.response.data.errors
                }
            })

        }else if(props.action === 'update'){
           
            axios_post_simple(`../courrier-sortant/${props.courrier_sortant.id}/update`,form.value).then(({data})=>{
              
                if (data.type === 'success') {
                    
                    emit('newUpdated')
                }
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
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

        axios_get('../courrier-sortant/new').then(({data})=>{

            if (props.action === 'add') {

                form.value.number = data

            }
            
        })  
    })
</script>