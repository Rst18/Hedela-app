<template>
    <div class="shadow-sm border p-4 m-2">
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
                <div class="text-red-500" v-if="errors.nom">
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
                <div class="text-red-500" v-if="errors.titre">
                        {{ errors.nom[0]}}
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
        <fwb-button @click="save" class="rounded-lg mt-2 hover:bg-gray-200 hover:dark:bg-gray-600 border">
          {{option === 'add' ? 'Enregistrer' :'Modifier'}}
        </fwb-button>

    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import { FwbA, FwbButton, FwbTextarea,FwbInput } from 'flowbite-vue'
    import EditorComponent from '@/Components/EditorComponent.vue'
    import SelectComponent from '@/Components/Task/SelectComponent.vue'
    import Swal from 'sweetalert2';

    const {axios_post_simple} = useAxios();
    const emit = defineEmits(['new'])
    const props = defineProps({
        
        option:String,
        task:Object
    })
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
                axios_post_simple('task-save',form.value).then(({data})=>{
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('new',data.new)
                        form.value ={}
                    })
                }).catch((error)=>{
                    console.log(error.response);
                })
            }else if(props.option ==='update'){
               let id = props.task.id
                axios_post_simple('task-update/'+id,form.value).then(({data})=>{
                    console.log(data);
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                      
                       // form.value = {}
                    })
                }).catch((error)=>{
                    console.log(error.response);
                })
            }
        }

  
    


    
    const errors =ref([]);

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