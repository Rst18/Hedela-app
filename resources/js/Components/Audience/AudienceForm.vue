<template>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Rostand M"
                label="Demandeur"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.phone"
                placeholder="243975476177"
                label="Telephone"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.phone">
                {{ errors.phone[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.fonction"
                placeholder="Directeur BNN"
                label="Fonction"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.fonction">
                {{ errors.fonction[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.email"
                placeholder="bnn@ac.cd"
                label="Adresse mail"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.email">
                {{ errors.email[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.piece"
                placeholder="XXX-XXX-XXX"
                label="Numero Piece identite"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.piece">
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
            <div class="text-red-500 text-xs py-2" v-if="errors.motif">
                {{ errors.motif[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.date_proposition"
               
                label="Proposition Date"
                type="date"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.date_proposition">
                {{ errors.date_proposition[0]}}
            </div>
        </div>
        <div>
           <SelectComponent @selectedOption="getSeletedOption" :options="users">
            Choisir l'autorite
           </SelectComponent>
            <div class="text-red-500 text-xs py-2" v-if="errors.user_requested">
                {{ errors.user_requested[0]}}
            </div>
        </div>
        <div class="mt-4">
        
            <Fwb-button class="bg-gray-800 hover:bg-slate-700" @click="submitForm">
                Enregistrer
            </Fwb-button>
            <Fwb-button @click="addAcc = true" class="bg-gray-500 hover:bg-slate-400 ml-8">
                Ajout Accompagnateurs
            </Fwb-button>
        </div>
    

    </div>
    <div>
        <AjoutAccompagnateurForm @add="addAccompagnateur" v-if="addAcc"/>
        <ListAccompagnateurs @delete="removeElement" :accompagnateurs v-if="addAcc"/>
    </div>
</template>
<script setup>

import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea } from 'flowbite-vue'
import SelectComponent from '@/Components/SelectComponent.vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import AjoutAccompagnateurForm from '@/Components/Audience/AjoutAccompagnateurForm.vue'
    import ListAccompagnateurs from '@/Components/Audience/ListAccompagnateurs.vue'
    import {ref} from 'vue'
    import Swal from 'sweetalert2';  

        const props = defineProps({
            audience:Object,
            option:String,
            users:Object
        })
        const addAcc= ref(false)

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
            fonction:props.audience.fonction,
            accompag :''
           


        })
        const errors = ref([])

        const getSeletedOption = (e) => form.value.user_requested = e

        const submitForm = ()=>{
            errors.value = [];
            if (props.option ==='add') {

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

        const accompagnateurs =ref([])
        const addAccompagnateur = (e)=>{
            accompagnateurs.value.push(e)
        }
        const removeElement =(e)=>{
            accompagnateurs.value = accompagnateurs.value.filter((el)=>el!=e)
        }

</script>