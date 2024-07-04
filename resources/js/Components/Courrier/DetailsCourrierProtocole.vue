<template>
    <div class="relative">
        <div class="grid grid-cols-12 py-1 px-6">
            <button   @click="close" class="border w-fit p-1 col-span-2 px-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Liste des courriers</button>
            <button   @click="update" class="border w-fit p-1 col-span-2 px-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Modifier</button>
           
        </div>

        <div class="grid grid-cols-12 px-6 gap-2">
            
                <div class="col-span-8">
                    <div class="grid grid-cols-2 gap-2 p-4 mb-2 shadow-md">
                        <div class="col-span-2 text-xl font-bold text-slate-700">
                            Details courrier
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Numero :</span>
                            <span> {{ courrierData.number }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Expeditaire :</span>
                            <span> {{ courrierData.sender }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Email :</span>
                            <span> {{ courrierData.email }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Phone :</span>
                            <span> {{ courrierData.phone }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Type Courrier :</span>
                            <span> {{ courrierData.type_courrier_name }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Objet :</span>
                            <span> {{ courrierData.objet }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Numero de la lettre :</span>
                            <span> {{ courrierData.letter_number }}</span>
                        </div>
                        <div class="shadow p-2">
                            <div class="grid grid-cols-1">
                                <span class="px-2 font-semibold text-slate-500">Lettre </span>
                                <a :href="'../download/'+ courrierData.letter_file.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-300 ml-4">Imprimer la lettre</a>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>
                                    <span class="px-2 font-semibold text-slate-500">Annexes ({{ courrierData.annexes.length }})</span>
                                    <span class="text-xs font-bold text-green-400 underline cursor-pointer" v-if="total_annexes > courrierData.annexes.length" @click="addAnnexes = !addAnnexes">{{ addAnnexes ? 'Annuler':'Ajouter Annexes' }}</span>
                                </div>
                                <div>
                                    <a v-for="annexe in courrierData.annexes" :href="'../download/'+ annexe.path.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-700 ml-4"> {{ annexe.name }}</a>
                                    <UploadAnnexes v-if="addAnnexes" v-for="doc in annexes_missed" :key="doc.id"  url="annexe-courrier/add" :model_id="courrierData.id" :name="doc.name"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>
<script setup>
   
    import moment from 'moment';
    import {ref,onMounted} from 'vue'
    import useAxios from '@/ComponentsServices/axios';
    
import UploadAnnexes from '@/Components/UploadAnnexes.vue'

    const props = defineProps({
        courrier:Object
    })

    const {axios_get} = useAxios()
    const emit = defineEmits(['closeMe','courrier'])
    const courrierData = ref(props.courrier)
    const showComponent = ref(1)
    const annexes_missed = ref()
    const total_annexes = ref()
    const addAnnexes = ref(false)
    
    const update = ()=>emit('courrier',props.courrier)


    onMounted(() => {

        axios_get('../service/'+props.courrier.service_id+'/get-doc').then(({data})=>{

            total_annexes.value = data.length
            annexes_missed.value = data.filter((obj) => !props.courrier.annexes.some((otherObj) => otherObj.name === obj.name));
          
        })  
    })


    const close = ()=> emit('closeMe')
    
</script>