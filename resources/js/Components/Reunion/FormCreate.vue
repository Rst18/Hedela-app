<template>
    <div class="grid grid-cols-1 ">

        <div v-show="activeTab == 1" class="grid grid-cols-2 shadow-md p-4 gap-4">
            <span class="col-span-2 py-2 text-3xl font-semibold text-gray-600">Information sur la reunion </span>
            <div class="col-span-2">
                <fwb-input
                    v-model="form.id"
                    placeholder="SN-RDC/240000000000001"
                    label="Code"
                    disabled
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
           <SelectComponent @selectedOption="getSeletedOption" :options="types">
                Choisir le type de reunion
            </SelectComponent>
                <div class="text-red-500 text-xs py-2" v-if="errors.user_requested">
                    {{ errors.user_requested[0]}}
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
            <div class="col-span-2  flex justify-end items-end">
                <Fwb-button @click="activeTab = 2" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Suivant
                </Fwb-button>

            </div>
        </div>
        <div v-show="activeTab == 2" class="grid grid-cols-1 shadow-md p-4 mt-2">
            <span class="col-span- py-2 text-3xl font-semibold text-gray-600">Configuration des Points a l'ordre de jour</span>
            <div class="">
                <OrdreJour @added="getOrdreJour" :ordreJour="{}" :reunion="{}"/>
            </div>
            <div class="flex justify-between">
                <Fwb-button  @click="activeTab = 1" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Precedent
                </Fwb-button>
                <!-- <Fwb-button @click="activeTab = 3" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Suivant
                </Fwb-button> -->

            </div>
        </div>
        <div v-show="activeTab == 3" class="grid grid-cols-1 shadow-md p-4 mt-2">
            <span class="col-span- py-2 text-3xl font-semibold text-gray-600">Configuration des orateurs</span>
            <div>
                <ListOrateur @listOrateur="getListOrateur"/>
            </div>

            <div class="  flex justify-between">
                <Fwb-button @click="activeTab = 2" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Precedent
                </Fwb-button>
                <!-- <Fwb-button @click="activeTab = 4" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Suivant
                </Fwb-button> -->

            </div>
        </div>

      
        <div v-show="activeTab == 4" class="mt-4 grid col-span-2">
            <div>

            </div>
            <div>
                
                <Fwb-button class="bg-gray-800 hover:bg-slate-700" @click="activeTab = 3">
                    Precedent
                </Fwb-button>
                <Fwb-button class="bg-green-700 hover:bg-slate-700" @click="submitForm">
                    Enregistrer
                </Fwb-button>
            </div>
        
          
        </div>
    

    </div>
</template>
<script setup>
import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios.js'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import InputDateTime from '@/Components/InputDateTime.vue'
import Swal from 'sweetalert2';  
import ListOrateur from './ListOrateur.vue'
import OrdreJour from './OrdreJour.vue'
import SelectComponent from '@/Components/SelectComponent.vue'

    const props = defineProps({
        users:Object,
        reunion:Object,
        types:Object,
        action:String
    })

    const emit = defineEmits(['added','updated'])
    const activeTab = ref(1)
    const {axios_post_simple,axios_get} = useAxios();
    const ordreJour = ref()
    const orateurs = ref()
    const form = ref({
        id:props.reunion.id,
        description:props.reunion.description,
        date_debut:props.reunion.date_debut,
        date_fin:props.reunion.date_fin,
        lien_zoom:props.reunion.lien_zoom,
        lien_youtube:props.reunion.lien_youtube,
        type_reunion_id:props.reunion.type_reunion_id,
        
    })
    const errors = ref([])


    const getOrdreJour = (e)=> {
        ordreJour.value = e 
            activeTab.value = 3
    }
        
    const getListOrateur = (e)=> {
        orateurs.value = e
        activeTab.value = 4
    }
    const getSeletedOption = (e) => form.value.type_reunion_id = e


    const submitForm = ()=>{

        errors.value = [];
        form.value.ordreJour =  ordreJour.value
        form.value.orateurs =  orateurs.value

        if (props.action ==='add') {

            axios_post_simple('../../reunion/add',form.value).then(({data})=>{
                
                console.log(data)

                if (data.type ==='success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        form.value = {}
                        activeTab.value = 1
                        emit('added',data.new)
                        getNewID()
                    })

                }
                Swal.fire(data.type,data.message,data.type)

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

    const getNewID = ()=> axios_get('../reunion/newID').then(({data})=>form.value.id = data) 

    onMounted(() => getNewID())

</script>