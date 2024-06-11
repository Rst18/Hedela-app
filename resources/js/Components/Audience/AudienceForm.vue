<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Rostand M"
                label="Names"
            />
            <div class="text-red-500" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.phone"
                placeholder="243975476177"
                label="Telephone"
            />
            <div class="text-red-500" v-if="errors.phone">
                {{ errors.phone[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.fonction"
                placeholder="Directeur BNN"
                label="Fonction"
            />
            <div class="text-red-500" v-if="errors.fonction">
                {{ errors.fonction[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.email"
                placeholder="bnn@ac.cd"
                label="Adresse mail"
            />
            <div class="text-red-500" v-if="errors.email">
                {{ errors.email[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.piece"
                placeholder="XXX-XXX-XXX"
                label="Numero Piece identite"
            />
            <div class="text-red-500" v-if="errors.piece">
                {{ errors.piece[0]}}
            </div>
        </div>
        <div>
            <fwb-textarea
                v-model="form.motif"
                placeholder="Entretien"
                :rows="2"
                label="Motif de l'audience"
            />
            <div class="text-red-500" v-if="errors.motif">
                {{ errors.motif[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.date_proposition"
               
                label="Proposition Date"
                type="date"
            />
            <div class="text-red-500" v-if="errors.date_proposition">
                {{ errors.date_proposition[0]}}
            </div>
        </div>
        <div>
           <SelectComponent @selectedOption="getSeletedOption" :options="users">
            Choisir l'autorite
           </SelectComponent>
            <div class="text-red-500" v-if="errors.user_requested">
                {{ errors.user_requested[0]}}
            </div>
        </div>
        <div class="mt-4">
        <Fwb-button @click="submitForm">
            Enregistrer
        </Fwb-button>
    </div>
    </div>
</template>
<script setup>

import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea } from 'flowbite-vue'
import SelectComponent from '@/Components/SelectComponent.vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import {ref} from 'vue'
        
        const props = defineProps({
            audience:Object,
            option:String,
            users:Object
        })

        const emit = defineEmits(['added','updated'])

        const {axios_post_simple} = useAxios();
        const form = ref({
            name:props.audience.name,
            email:props.audience.email,
            phone:props.audience.phone,
            motif:props.audience.motif,
            user_requested:'',
            date_proposition:props.audience.date_proposition,
            piece:props.audience.piece,
            fonction:props.audience.fonction


        })
        const errors = ref([])

        const getSeletedOption = (e) => form.value.user_requested = e

        const submitForm = ()=>{
            console.log(form.value);
            if (props.option ==='add') {

                axios_post_simple('../../audience/add',form.value).then(({data})=>{
                    console.log(data);
                   if (data.type ==='success') {
                        emit('added',data.new)
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