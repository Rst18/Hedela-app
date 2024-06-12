<template>
    <div class="grid grid-cols-1 gap-4 py-6 lg:px-10">
        <span class="col-span-1 text-xl font-semibold text-gray-600">{{ option ==='add' ? "Créer un Rendez vous":'Modifier Rendez vous' }}</span>
        <div>
            <fwb-input
                v-model="form.lieu"
                placeholder="Cabinet du Ministre"
                label="Lieu"
            />
            <div class="text-red-500" v-if="errors.lieu">
                {{ errors.lieu[0]}}
            </div>
        </div>
        <div>
            <InputDateTime label="date_heure" :defaultDate="form.date_heure" @inputValue="get_date_heure">
                Date et heure du rendez vous
            </InputDateTime>
            <div class="text-red-500" v-if="errors.date_heure">
                {{ errors.date_heure[0]}}
            </div>
        </div>
       
       
        <div class="mt-4">
            <Fwb-button class="bg-gray-800" @click="submitForm">
                Enregistrer
            </Fwb-button>
        </div>
    </div>
</template>
<script setup>

    import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea } from 'flowbite-vue'
    import InputDateTime from '@/Components/InputDateTime.vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import {ref} from 'vue'
            
        const props = defineProps({
            audience_id:Number,
            rendezvous:Object,
            option:String
        })

        const emit = defineEmits(['added','updated'])

        const {axios_post_simple} = useAxios();
        const form = ref({
            audience_id:props.audience_id,
            date_heure:props.rendezvous.date_heure,
            lieu:props.rendezvous.lieu,
            status:2
        })
        const get_date_heure = (e)=> form.value.date_heure = e
        const errors = ref([])

        const getSeletedOption = (e) => form.value.user_requested = e

        const submitForm = ()=>{
            if (props.option ==='add') {

                axios_post_simple('../../rendezvous/add',form.value).then(({data})=>{
                    console.log(data);
                   if (data.type ==='success') {
                        emit('added',data.new)
                   }
                })
            }else if(props.option ==='update'){

                let id = props.rendezvous.id;

                axios_post_simple('../../rendezvous/update/'+id,form.value).then(({data})=>{
                    console.log(data);
                    if (data.type ==='success') {
                        emit('updated',data.new)
                    }
                })
            }
        }


</script>