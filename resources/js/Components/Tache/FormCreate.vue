<template>
    <div class="border p-8 w-max-lg m-2">
        <div class="py-2 ">
            <span class="font-bold text-gray-600 text-xl">{{ option === 'add' ?'Créer une Tache':'Modifier la tache' }}</span>
        </div>
        <div class="grid grid-cols-1 ">
            <div>
                <fwb-input
                    v-model="form.nom"
                    placeholder="Ecrire le nom de la tache"
                    label="Nom"
                />
                <div class="text-red-500 text-xs py-1" v-if="errors.nom">
                        {{ errors.nom[0]}}
                </div>
            </div>
            <div>
                <fwb-input
                    v-model="form.date_limite"
                    placeholder="Date Limite "
                    label="Date Limite"
                    type="date"
                />
                <div class="text-red-500 text-xs py-1" v-if="errors.date_limite">
                        {{ errors.date_limite[0]}}
                </div>
            </div>
            <div class="flex col-2 gap-2 pb-2">
    
                <div class="w-[50%]">
                    <SelectComponent :options="priorites" @selectedValue="getPriorite">
                        Priorité
                    </SelectComponent>
                </div>
                <div class="w-[50%]">
                    <SelectComponent :options="statuts" @selectedValue="getStatut">
                        Statut
                    </SelectComponent>
                </div>
            </div>
            <div>
                <EditorComponent v-model="form.description"/>
            </div>
        </div>
        <fwb-button @click="save" class="rounded-lg mt-2 bg-gray-800 hover:bg-gray-700 hover:dark:bg-gray-600 border">
          {{option === 'add' ? 'Enregistrer' :'Modifier'}}
        </fwb-button>

    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import { FwbA, FwbButton, FwbTextarea,FwbInput } from 'flowbite-vue'
    import EditorComponent from '@/Components/EditorComponent.vue'
    import SelectComponent from '@/Components/Tache/SelectComponent.vue'
    import Swal from 'sweetalert2';

    const {axios_post_simple} = useAxios();
    const emit = defineEmits(['new'])
    const props = defineProps({
        
        option:String,
        task:Object
    })
    const errors =ref([]);
    const form = ref({
        nom:props.task.nom,
        description:props.task.description,
        date_limite:props.task.date_limite,
        statut:props.task.statut,
        priorite:props.task.priorite
    })
    
    const getPriorite = (e)=>  form.value.priorite = e
    const getStatut = (e)=>  form.value.statut = e

    
        
        const save = ()=>{

            if (props.option === 'add') {
                axios_post_simple('../task-save',form.value).then(({data})=>{

                    if (data.type === 'success') {
                        
                        Swal.fire(data.type,data.message,data.type).then(()=>{
                            emit('new',data.new)
                            form.value ={}
                        })
                    }
                }).catch((error)=>{
                   if (error.response.status === 422) {
                        errors.value = error.response.data.errors
                   }
                })
            }else if(props.option ==='update'){
               let id = props.task.id
                axios_post_simple('task-update/'+props.task.id,form.value).then(({data})=>{
                    console.log(data);
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                      
                       // form.value = {}
                    })
                }).catch((error)=>{
                    console.log(error.response);
                })
            }
        }

    
    

    const priorites = [
        {
            id:1,
            name:'Très élevé'

        },
        {
            id:2,
            name:'Elevé'

        },
        {
            id:3,
            name:'Moyen'

        },
        {
            id:4,
            name:'Faible'

        },
    ]
    const statuts = [
        {
            id:1,
            name:'Ouvert'

        },
        {
            id:2,
            name:'Fermé'

        },
        {
            id:3,
            name:'Suspendu'

        },
    ]
</script>