<template>
    <div class="grid grid-cols-2 gap-2 p-4">
        <div>
            <fwb-textarea
                v-model="form.faits"
                placeholder="Faits"
                :rows="2"
                label="Faits"
            />
            <div class="text-red-500" v-if="errors.faits">
                {{ errors.faits[0]}}
            </div>
        </div>
        <div>
            <fwb-textarea
                v-model="form.analyse"
                placeholder="analyse"
                :rows="2"
                label="Analyse"
            />
            <div class="text-red-500" v-if="errors.analyse">
                {{ errors.analyse[0]}}
            </div>
        </div>
        <div>
            <fwb-textarea
                v-model="form.conclusion"
                placeholder="Conclusion"
                :rows="2"
                label="Conclusion"
            />
            <div class="text-red-500" v-if="errors.conclusion">
                {{ errors.conclusion[0]}}
            </div>
        </div>
        <div>
            <fwb-textarea
                v-model="form.actions"
                placeholder="Actions"
                :rows="2"
                label="Actions"
            />
            <div class="text-red-500" v-if="errors.actions">
                {{ errors.actions[0]}}
            </div>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-2 p-4">
        <div>
            <fwb-input
                v-model="form.objet"
                placeholder="objet"
                :rows="2"
                label="objet"
            />
            <div class="text-red-500" v-if="errors.objet">
                {{ errors.objet[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.destinataire"
                placeholder="destinataire"
                :rows="2"
                label="destinataire"
            />
            <div class="text-red-500" v-if="errors.destinataire">
                {{ errors.destinataire[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.signataire"
                placeholder="signataire"
                :rows="2"
                label="signataire"
            />
            <div class="text-red-500" v-if="errors.signataire">
                {{ errors.signataire[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.copiea"
                placeholder="copiea"
                :rows="2"
                label="copiea"
            />
            <div class="text-red-500" v-if="errors.copiea">
                {{ errors.copiea[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.annexes"
                placeholder="annexes"
                :rows="2"
                label="annexes"
            />
            <div class="text-red-500" v-if="errors.annexes">
                {{ errors.annexes[0]}}
            </div>
        </div>
        <div>
           <SelectComponent @selectedOption="getSeletedOption" :options="typeLettre">
            Choisir le type de lettre
           </SelectComponent>
            <div class="text-red-500" v-if="errors.annexes">
                {{ errors.annexes[0]}}
            </div>
        </div>
       

        
    </div>
    <div class="p-4">
        <EditorComponent v-model="form.lettre"/>
    </div>
    <div class="mt-4">
        <Fwb-button @click="submitForm">
            Enregistrer
        </Fwb-button>
    </div>
    <SuccesToast message="Note Technique Enregistré" v-if="success"/>
</template>
<script setup>

import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea  } from 'flowbite-vue'
import {ref,onMounted} from 'vue'
import EditorComponent from '@/Components/EditorComponent.vue'
import useAxios from '@/ComponentsServices/axios.js';
import SelectComponent from '../SelectComponent.vue';
import SuccesToast from '@/Components/SuccesToast.vue'
    const props = defineProps({

        courrier:Object
    })
    const {axios_post_simple} = useAxios()
    const errors = ref([])
    const success = ref(false)
    const form = ref({
        faits:'',
        analyse:'',
       conclusion:'',
       actions:'',
       objet:'',
       destinataire:'',
       signataire:'',
       copiea:'',
       type_lettre:'',
       annexes:'',
        lettre:'',
        courrier_id:props.courrier.id
    })

    const submitForm = ()=>{
        axios_post_simple('note-technique/add',form.value).then(({data})=>{
            if (data.type ==='success') {
                success.value = true
            }
        }).catch((error)=>{
            console.log(error.response);
        })
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