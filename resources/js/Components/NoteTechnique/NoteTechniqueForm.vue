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
        <div :class="errors.annexes ?'border-red-600' :''">
            <fwb-input
                v-model="form.annexes"
                placeholder="annexes"
                :rows="2"
                label="Annexes"
            />
            <div class="text-red-500 text-xs" v-if="errors.annexes">
                {{ errors.annexes[0]}}
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
    <div class="mt-4">
        <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="submitForm">
            Enregistrer
        </Fwb-button>
    </div>
    <SuccesToast message="Note Technique Enregistré" v-if="success"/>
</template>

<script setup>

import { FwbInput,FwbButton,FwbTextarea  } from 'flowbite-vue'
import {ref,onMounted} from 'vue'
import EditorComponent from '@/Components/EditorComponent.vue'
import useAxios from '@/ComponentsServices/axios.js';
import SelectComponent from '../SelectComponent.vue';
import SuccesToast from '@/Components/SuccesToast.vue'

    const props = defineProps({

        courrier:Object,
        note:Object,
        action:String
    })

    const emit = defineEmits(['added','updated'])
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
        annexes:props.note.annexes,
        lettre:props.note.lettre,
        courrier_id:props.courrier ? props.courrier.id : props.note.courrier_id
    })

    const submitForm = ()=>{
        errors.value = []
        if (props.action ==='add') {

            axios_post_simple('note-technique/add',form.value).then(({data})=>{
              console.log(data);
                if (data.type ==='success') {
                    success.value = true
                    emit('added',data.new)
                }

            }).catch((error)=>{
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors
                }
                console.log(error.response);
            })
            
        }else if(props.action ==='update'){
            // let id =
            axios_post_simple('note-technique/update/'+props.note.id,form.value).then(({data})=>{
                console.log(data);
                if (data.type ==='success') {
                    success.value = true
                    emit('updated')
                }
            }).catch((error)=>{
                console.log(error.response);
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
    ]
</script>