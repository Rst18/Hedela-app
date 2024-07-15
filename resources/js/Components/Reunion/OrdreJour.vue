<template>
    <div class="mb-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <fwb-input
                    v-model="form.name"
                    placeholder="Point à l'ordre du jour..."
                    label="Point à l'ordre du jour"
                />
                <div class="text-red-500 text-xs py-2" v-if="errors.name">
                    {{ errors.name[0]}}
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
            
            <div class="col-span-2">
                <fwb-file-input v-model="form.annexes" label="Ajouter des annexes" multiple />
                <div class="text-red-500 text-xs py-1" v-if="errors.annexes">
                    {{ errors.annexes[0]}}
                </div>
            </div>
          
            <div class="mt-4  col-span-2 flex justify-between">
            
                <Fwb-button @click="add" class="bg-gray-800 hover:bg-slate-700">
                    Ajouter
                </Fwb-button>

                <Fwb-button @click="sendData" class="bg-gray-800 hover:bg-slate-700">
                    Terminer et passer
                </Fwb-button>
              
            </div>
        </div>
    
        <div class="text-xs">
            <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 gap-1">
                <div class="col-span-1">#</div>
                <div class="col-span-3">Name</div>
                <div class="col-span-5">Description</div>
                <div class="col-span-1">Nombre Annexes</div>
                <div class="col-span-1">Options</div>
            </div>
            <div v-for="b of ordreJours" :key="b.id" class="w-full p-3 grid grid-cols-12 gap-1 hover:bg-slate-200 hover:cursor-pointer">
                <div class="col-span-1">#</div>
                <div class="col-span-3">{{b.name }}</div>
                <div class="col-span-5">{{b.description }}</div>
                <div class="col-span-1">{{b.annexes.length }}</div>
                <div @click="removeItem(b)" class="col-span-1">X</div>
                
            </div>
        </div>

    </div>
</template>
<script setup>
import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios.js'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import Swal from 'sweetalert2';  

        const props = defineProps({
            reunion:Object,
            ordreJour:Object,
        })

        const emit = defineEmits(['added','updated'])
        const ordreJours = ref(props.ordreJour ? props.ordreJour :[])
        const {axios_post_simple} = useAxios();
        const form = ref({
            name:'',
            description:'',
            annexes:[]
        })
        const errors = ref([])

        const add = ()=>{
            if (form.value.name != '') {
                
                ordreJours.value.push(
                    {
                        id:ordreJours.value.length + 1,
                        name:form.value.name,
                        description:form.value.description,
                        annexes:form.value.annexes,
                    }
                )
            }else alert('Veillez remplir les champs vides')
        }
        const removeItem = (obj)=>{
            ordreJours.value = ordreJours.value.filter((o)=> o != obj)
        }

        const sendData = ()=>{
            emit('added', ordreJours.value)
        }

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