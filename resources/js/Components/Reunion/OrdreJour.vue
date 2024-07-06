<template>
    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-2">
            <fwb-input
                v-model="form.name"
                placeholder="Point à l'ordre du jour..."
                label="Point à l'ordre du jour"
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
      
        <div class="mt-4">
        
            <Fwb-button class="bg-gray-800 hover:bg-slate-700">
                Enregistrer
            </Fwb-button>
          
        </div>
    

    </div>
</template>
<script setup>
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios.js'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import InputDateTime from '@/Components/InputDateTime.vue'
import Swal from 'sweetalert2';  

        const props = defineProps({
            reunion:Object,
            ordreJour:Object,
        })

        const emit = defineEmits(['added','updated'])

        const {axios_post_simple} = useAxios();
        const form = ref({
            name:props.ordreJour.name,
            description:props.ordreJour.description,
           


        })
        const errors = ref([])

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



</script>