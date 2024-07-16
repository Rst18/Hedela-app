<template>
    <div class="grid grid-cols-1">

        <div v-show="activeTab == 1" class="grid grid-cols-2 shadow-md p-4 gap-4">
            <span class="col-span-2 py-2 text-3xl font-semibold text-gray-600">Information sur le sondage </span>
            <div class="col-span-2">
                <fwb-input
                    v-model="form.reunion_id"
                    placeholder="SN-RDC/240000000000001"
                    label="Code"
                    disabled
                />
                <div class="text-red-500 text-xs py-2" v-if="errors.reunion_id">
                    {{ errors.reunion_id[0]}}
                </div>
            </div>
            <div class="col-span-2">
                <fwb-textarea
                    v-model="form.description"
                    placeholder="Description"
                    :rows="1"
                    label="Description"
                />
                <div class="text-red-500 text-xs py-2" v-if="errors.description">
                    {{ errors.description[0]}}
                </div>
            </div>
            <div class="col-span-2  flex justify-end items-end">
                <Fwb-button @click="activeTab = 2" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Suivant
                </Fwb-button>

            </div>
        </div>
        <div v-show="activeTab == 2" class="grid grid-cols-1 shadow-md p-4 mt-2">
            <span class="col-span- py-2 text-3xl font-semibold text-gray-600">Sondage Item</span>
            <div class="">
                <SondageItemForm @added="getSondageItems"  :reunion/>
            </div>
            <div class="flex justify-between">
                <Fwb-button  @click="activeTab = 1" class="bg-gray-800 hover:bg-slate-700 mt-2">
                    Precedent
                </Fwb-button>

            </div>
        </div>
        <div v-show="activeTab == 3" class="mt-4 grid col-span-2">
            <div>

            </div>
            <div>

                <Fwb-button class="bg-gray-800 hover:bg-slate-700" @click="activeTab = 2">
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
import Swal from 'sweetalert2';
import SondageItemForm from './SondageItemForm.vue'
    const props = defineProps({

        sondage:Object,
        reunion:Object,
        action:String
    })

    const emit = defineEmits(['added','updated'])
    const activeTab = ref(1)
    const {axios_post_simple,axios_get} = useAxios();
    const sondage_items = ref(props.reunion.ordres_du_jour)

    const form = ref({

        reunion_id:props.reunion.id,
        description:props.reunion.description,

    })
    const errors = ref([])


    const getSondageItems = (e)=> {
        sondage_items.value = e
            activeTab.value = 3
    }




    const submitForm = ()=>{

        errors.value = [];
        form.value.sondage_items =  sondage_items.value

        if (props.action ==='add') {

            axios_post_simple('../../sondage/add',form.value).then(({data})=>{

                console.log(data)

                if (data.type ==='success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        form.value = {}
                        activeTab.value = 1
                        emit('added',data.new)
                    })

                }
                Swal.fire(data.type,data.message,data.type)

            }).catch((error)=>{
                if(error.response.status === 422){
                    errors.value = error.response.data.errors
                }
            })
        }else if(props.action ==='update'){
            form.value.reunion = props.reunion.id
            axios_post_simple(`../../reunion/update`,form.value).then(({data})=>{
               console.log(data);
                if (data.type ==='success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{

                        emit('updated')

                    })

                }Swal.fire(data.type,data.message,data.type)
            })
        }
    }



</script>
