<template>
    <div class="grid grid-cols-2 gap-2 p-4">
        <div :class="errors.faits ?'border p-2 rounded-xl border-red-600' :''">
            <fwb-textarea
                v-model="form.faits"
                placeholder="Faits"
                :rows="2"
                label="Faits"
            />
            <div class="text-red-500 text-xs" v-if="errors.faits">
                {{ errors.faits[0]}}
            </div>
        </div>
        <div :class="errors.analyse ?'border-red-600' :''">
            <fwb-textarea
                v-model="form.analyse"
                placeholder="analyse"
                :rows="2"
                label="Analyse"
            />
            <div class="text-red-500 text-xs" v-if="errors.analyse">
                {{ errors.analyse[0]}}
            </div>
        </div>
        <div :class="errors.conclusion ?'border-red-600' :''" >
            <fwb-textarea
                v-model="form.conclusion"
                placeholder="Conclusion"
                :rows="2"
                label="Conclusion"
            />
            <div class="text-red-500 text-xs" v-if="errors.conclusion">
                {{ errors.conclusion[0]}}
            </div>
        </div>
        <div :class="errors.actions ?'border-red-600' :''">
            <fwb-textarea
                v-model="form.actions"
                placeholder="Actions"
                :rows="2"
                label="Actions"
            />
            <div class="text-red-500 text-xs" v-if="errors.actions">
                {{ errors.actions[0]}}
            </div>
        </div>
        <div :class="errors.annexes ?'border-red-600' :''">
            <fwb-input
                v-model="form.annexe"
                placeholder="annexes"
                label="Annexes"
                type="number"
            />
            <div class="text-red-500 text-xs" v-if="errors.annexe">
                {{ errors.annexe[0]}}
            </div>
        </div>
        <div></div>
        <span   @click="ajouter_lettre = !ajouter_lettre" class="text-xs text-green-500 cursor-pointer font-semibold ">Ajouter un lettre</span>
    </div>
    <div v-show="ajouter_lettre" class="grid grid-cols-3 gap-2 p-4">
        <div :class="errors.objet ?'border-red-600' :''">
            <fwb-input
                v-model="form.objet"
                placeholder="objet"
                :rows="2"
                label="Objet"
            />
            <div class="text-red-500 text-xs" v-if="errors.objet">
                {{ errors.objet[0]}}
            </div>
        </div>
        <div :class="errors.destinataire ?'border-red-600' :''">
            <fwb-input
                v-model="form.destinataire"
                placeholder="destinataire"
                :rows="2"
                label="Destinataire"
            />
            <div class="text-red-500 text-xs" v-if="errors.destinataire">
                {{ errors.destinataire[0]}}
            </div>
        </div>
        <div :class="errors.signataire ?'border-red-600' :''">
            <fwb-input
                v-model="form.signataire"
                placeholder="signataire"
                :rows="2"
                label="Signataire"
            />
            <div class="text-red-500 text-xs" v-if="errors.signataire">
                {{ errors.signataire[0]}}
            </div>
        </div>
        <div :class="errors.copiea ?'border-red-600' :''">
            <fwb-input
                v-model="form.copiea"
                placeholder="Copie à "
                :rows="2"
                label="Copie à"
            />
            <div class="text-red-500 text-xs" v-if="errors.copiea">
                {{ errors.copiea[0]}}
            </div>
        </div>
       
        <div :class="errors.type_lettre ?'border-red-600' :''">
           <SelectComponent @selectedOption="getSeletedOption" :options="typeLettre">
            Choisir le type de lettre
           </SelectComponent>
            <div class="text-red-500 text-xs" v-if="errors.type_lettre">
                {{ errors.type_lettre[0]}}
            </div>
        </div>
       

        
    </div>
    <div  v-show="ajouter_lettre" class="p-4" :class="errors.lettre ?'border-red-600' :''">
        <EditorComponent v-model="form.lettre"/>
    </div>
    <div v-if="addAnnexes" class="p-6">
        <span class="text-gray-700 font-semibold text-xl py-2 px-2  text-center">Ajouter les Annexes </span>
        <div class="p-8 ">
            <UploadAnnexes v-for="number in form.annexe" url="../annexe-note/add" :model_id="newNote ? newNote.id : note.id " :name="'Annexe '+number" />
        </div>
    </div>
    <div class="mt-4">
        <Fwb-button  v-if="addAnnexes" class="bg-gray-800 hover:bg-gray-600" @click="finish">
            Terminer
        </Fwb-button>
        <Fwb-button v-else class="bg-gray-800 hover:bg-gray-600" @click="submitForm">
            Enregistrer
        </Fwb-button>
       
    </div>
    <!-- <SuccesToast message="Note Technique Enregistré" v-if="success"/> -->
</template>

<script setup>

import { FwbInput,FwbButton,FwbTextarea  } from 'flowbite-vue'
import {ref,onMounted} from 'vue'
import EditorComponent from '@/Components/EditorComponent.vue'
import useAxios from '@/ComponentsServices/axios.js';
import SelectComponent from '../SelectComponent.vue';

import UploadAnnexes from '@/Components/UploadAnnexes.vue'
import SuccesToast from '@/Components/SuccesToast.vue'

import Swal from 'sweetalert2';
    const props = defineProps({

        courrier:Object,
        note:Object,
        action:String
    })

    const emit = defineEmits(['added','updated','closeMe'])

    const {axios_post_simple} = useAxios()
    const errors = ref([])
    const success = ref(false)
    const ajouter_lettre = ref(false)
    const form = ref({
        faits:props.note.faits,
        analyse:props.note.analyse,
        conclusion:props.note.conclusion,
        actions:props.note.actions,
        objet:props.note.objet,
        destinataire:props.note.destinataire,
        signataire:props.note.signataire,
        copiea:props.note.copiea,
        type_lettre:props.note.type_lettre,
        annexe:props.note.annexe,
        lettre:props.note.lettre,
        courrier_id:props.courrier ? props.courrier.id : props.note.courrier_id
    })

    const newNote  = ref();
    const addAnnexes  = ref(false);

    const submitForm = ()=>{
        errors.value = []
        if (props.action ==='add') {

            axios_post_simple('../note-technique/add',form.value).then(({data})=>{
                
         
                
                if (data.type ==='success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{
                          //success.value = true
                        newNote.value = data.new

                        addAnnexes.value = true
                        // emit('added',data.new)
                    })
                  
                }

            }).catch((error)=>{

                if (error.response.status === 422) {
                    errors.value = error.response.data.errors
                }
            })
            
        }else if(props.action ==='update'){
            axios_post_simple(`../note-technique/update/${props.note.id}`,form.value).then(({data})=>{

                if (data.type === "success") {

                    Swal.fire(data.type,data.message,data.type).then(()=>{

                        addAnnexes.value = true
                    })
                }
            }).catch((error)=>{
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors
                }
            })
        }
    }
    const getSeletedOption = (e)=>{
        form.value.type_lettre = e
    }
    const typeLettre = [
        {
            id:1,
            name:'Invitation'
        },
        {
            id:2,
            name:'Convocation'
        },
        {
            id:3,
            name:'Arrêté'
        },
        {
            id:4,
            name:'Reponse simple'
        },
    ]

    const finish = ()=>{
        emit('closeMe')
    }
</script>