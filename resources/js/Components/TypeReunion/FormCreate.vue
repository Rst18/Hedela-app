<template>
    <div class="p-4 grid grid-cols-1 shadow-md rounded-md">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Nom type reunion"
                label="Entrer le nom du type de reunion"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
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

        <div class="py-2">
            <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="submitForm">
                Enregistrer
            </Fwb-button>
        </div>

    </div>
</template>
<script setup >
import { FwbInput,FwbButton,FwbTextarea,FwbP } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import {ref} from 'vue'
    const props = defineProps(
        {
            type_reunion:Object,
            action:String
        }
    )
    const emit = defineEmits(['newAdded','updated'])
    const { axios_post_simple } = useAxios();

    const form = ref({
        name:props.type_reunion.name,
        description:props.type_reunion.description,
    })
    const errors = ref([]);

    const submitForm = ()=>{

        if (props.action === 'add') {

            axios_post_simple('../type-reunion/add',form.value).then(({data})=>{
                if (data.type ==='success') {
                    emit('newAdded',data.new)

                }
            }).catch((error)=>{
                console.log(error.response)
            })

        }else if(props.action === 'update'){
            axios_post_simple(`../type-reunion/${props.type_reunion.id}/update`,form.value).then(({data})=>{
                if (data.type === 'success') {

                    emit('updated')
                }
            }).catch((error)=>{
                console.log(error.response)
            })
        }
        else{

        }
    }



</script>
