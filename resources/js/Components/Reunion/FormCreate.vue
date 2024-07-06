<template>
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2">
            <fwb-input
                v-model="form.id"
                placeholder="SN-RDC/240000000000001"
                label="Code"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.id">
                {{ errors.id[0]}}
            </div>
        </div>
        <div class="col-span-2">
            <fwb-textarea
                v-model="form.description"
                placeholder="Description"
                :rows="2"
                label="Description"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.description">
                {{ errors.description[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.lien_zoom"
                placeholder=""
                label="Lien_zoom"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.lien_zoom">
                {{ errors.lien_zoom[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.lien_youtube"
                placeholder=""
                label="Lien youtube"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.lien_youtube">
                {{ errors.lien_youtube[0]}}
            </div>
        </div>
        <div class="flex col-span-2 gap-2">
            <div class="w-[50%]" >
                <InputDateTime label="date_debut" :defaultDate="form.date_debut" @inputValue="getDateDebut">
                    Date et heure de Debut
                </InputDateTime>
                <div class="text-red-500" v-if="errors.date_debut">
                        {{ errors.date_debut[0]}}
                </div>
            </div>
            <div class="w-[50%]">
                <InputDateTime label="date_fin" :defaultDate="form.date_fin"  @inputValue="getDateFin">
                    Date et heure de fin
                </InputDateTime>
                <div class="text-red-500" v-if="errors.date_fin">
                    {{ errors.date_fin[0]}}
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <OrdreJour :ordreJour="{}" :reunion="{}"/>
        </div>
        <div class="col-span-2">
            <ListOrateur/>
        </div>
      
        <div class="mt-4">
        
            <Fwb-button class="bg-gray-800 hover:bg-slate-700" @click="submitForm">
                Enregistrer
            </Fwb-button>
          
        </div>
    

    </div>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import FormCreate from '@/Components/Reunion/FormCreate.vue';
import useAxios from '@/ComponentsServices/axios.js'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import InputDateTime from '@/Components/InputDateTime.vue'
import Swal from 'sweetalert2';  
import ListOrateur from './ListOrateur.vue'
import OrdreJour from './OrdreJour.vue'

        const props = defineProps({
            users:Object,
            reunion:Object,
            action:String
        })

        const emit = defineEmits(['added','updated'])

        const {axios_post_simple} = useAxios();
        const form = ref({
            name:props.reunion.name,
            email:props.reunion.email,
            phone:props.reunion.phone,
            motif:props.reunion.motif,
            user_requested:'',
            date_proposition:props.reunion.date_proposition,
            piece:props.reunion.piece,
            fonction:props.reunion.fonction,
            date_debut :'',
            date_fin :'',
           


        })
        const errors = ref([])

        const getSeletedOption = (e) => form.value.user_requested = e

        const submitForm = ()=>{
            errors.value = [];
            if (props.action ==='add') {

                form.value.accompag = JSON.stringify(accompagnateurs.value)

                axios_post_simple('../../audience/add',form.value).then(({data})=>{
                    console.log(data)

                   if (data.type ==='success') {

                        Swal.fire(data.type,data.message,data.type).then(()=>{
                            addAcc.value = false
                            form.value = {}
                            emit('added',data.new)
                        })

                   }
                }).catch((error)=>{
                    console.log(error.response)
                    if(error.response.status === 422){
                        errors.value = error.response.data.errors
                    }
                })
            }else if(props.option ==='update'){

                let id = props.audience.id;

                axios_post_simple('audience/update/'+id,form.value).then(({data})=>{
                    console.log(data);
                    if (data.type ==='success') {
                        
                        emit('added',data.new)
                    }
                })
            }
        }

        
    const getDateDebut = (e)=>form.value.date_debut = e
    const getDateFin = (e)=>form.value.date_fin = e


</script>