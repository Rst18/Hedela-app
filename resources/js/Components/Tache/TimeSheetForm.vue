<template>
    <div class="p-8 m-2 shadow-md rounded-md border">
        <div class="flex justify-center items-center font-bold text-gray-800 text-xl px-2">
            {{ task.nom }}
        </div>
        <div class="text-lg font-semibold py-4 text-gray-700">
           {{ option === 'add' ? ' Créer votre Timesheet' :' Modifier votre Timesheet' }}
        </div>
        <div class="grid grid-cols-1">
            <div  class="col-1 gap-2 pb-2">
                <div class="w-[50%]">
                    <fwb-input
                        v-model="form.date_jour"
                        placeholder="Date du jour "
                        label="Date du jour"
                        type="date"
                        :value="form.date_jour"
                    />
                    <div class="text-red-500" v-if="errors.date_jour">
                            {{ errors.date_jour[0]}}
                    </div>
                </div>
                <div class="flex gap-2">
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
            </div>
            <div>
                <EditorComponent v-model="form.description"/>
            </div>
        </div>
        <div>
            <fwb-button @click="close" class="rounded-lg mt-2 bg-red-700 text-white hover:bg-gray-200 hover:dark:bg-gray-600 border">
              Fermer
            </fwb-button>
            <fwb-button @click="save" class="rounded-lg mt-2 bg-gray-800 hover:bg-gray-700 hover:dark:bg-gray-600 border">
              Enregistrer
            </fwb-button>
        </div>

    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import { FwbA, FwbButton, FwbTextarea,FwbInput } from 'flowbite-vue'
    import EditorComponent from '@/Components/EditorComponent.vue'
    import SelectComponent from '@/Components/Tache/SelectComponent.vue'
    import Swal from 'sweetalert2';
    import InputDateTime from '@/Components/InputDateTime.vue'
    const {axios_post_simple} = useAxios();

    const props = defineProps({
        task:Object,
        timesheet:Object,
        option:String
    })
    const emit = defineEmits(['new','hide','update'])
    const form = ref({

        task_id:props.task.id,
        description:props.timesheet.description,
        date_jour:new Date(props.timesheet.date_jour).toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
        }),
        date_debut:props.timesheet.date_debut,
        date_fin:props.timesheet.date_fin,
    })
    

    const getDateDebut = (e)=>form.value.date_debut = e
    const getDateFin = (e)=>form.value.date_fin = e

    const save = ()=>{
        if (props.option === 'add') {
            
            axios_post_simple('../timesheet',form.value).then(({data})=>{
              //  console.log(data);
                if (data.type === 'success') {
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('new',data.new)
                        form.value ={}
                    })
                    
                }
            }).catch((error)=>{
    
                if (error.response.status === 422 ) {
                    errors.value = error.response.data.errors
                }
            })
        }else if(props.option ==='update'){
            let id = props.timesheet.id
            axios_post_simple(`../timesheet/${id}/update`,form.value).then(({data})=>{

                console.log(data);

                if (data.type === 'success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('update')
                    })
                    
                }
            }).catch((error)=>{
                console.log(error.response);
                if (error.response.status === 422 ) {
                    errors.value = error.response.data.errors
                }
            })
        }
    }

    const close = ()=>emit('hide')


    const errors =ref([]);

   
</script>