<template>
    <div class="p-4 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Diplome"
                label="Entrer le nom du type de courrier"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div class="my-2">
            <fwb-select
                v-model="form.degre_urgence"
                :options="degres"
                label="Degre d'urgence"
            />
            <div class="text-red-500" v-if="errors.degre_urgence">
                {{ errors.degre_urgence[0]}}
            </div>
        </div>
       
        <div>
            <Fwb-button @click="submitForm">
                Enregistrer
            </Fwb-button>
        </div>
        
    </div>
</template>
<script setup >
import { FwbInput,FwbButton,FwbRadio,FwbP,FwbSelect  } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import {ref} from 'vue'
import ToggleInput from '@/Components/ToggleInput.vue'
    const props = defineProps(
        {
            typeCourrier:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.typeCourrier.name,
        degre_urgence:props.typeCourrier.degre_urgence
    })
    const errors = ref([]);

    const degres = [
        { value: 1, name: 'Eleve' },
        { value: 2, name: 'Moyen' },
        { value: 3, name: 'Faible' },
    ] 

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('typecourrier/add',form.value).then(({data})=>{
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple('document/'+props.role.id+'/update',form.value).then(({data})=>{
                console.log(data)
                emit('newAdded',data.new)
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{
            
        }
    }

   
    
</script>