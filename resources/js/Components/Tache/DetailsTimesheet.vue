<template>
     <div class="grid grid-cols-12 py-2 shadow-sm rounded-sm px-4 gap-2">
        <Button @click="modification = true" class="bg-gray-100 hover:text-white text-gray-700 font-bold col-span-3">Modifier Timesheet</Button>
        <!-- <Button class="bg-gray-100 hover:text-white text-gray-700 font-bold  col-span-3"   >Modifier</Button> -->
    </div>
    <div v-if="timesheetData" v-show="!modification" class="grid grid-cols-12 mt-4 ">

        <div  class="col-span-2 border-r text-xs">
            <div v-if="ressources">
                <span class="font-bold">Ressources ({{ ressources.length }}) </span>
                <div class="flex flex-col">
                    <span @click="show_detail(ressource)" v-for="ressource in ressources" :key="ressource.id" class="text-xs m-2 hover:cursor-pointer hover:text-blue-600" >
                        {{ ressource.titre }}
                    </span>

                </div>
            </div>
            <div v-if="!ressources.length" class="flex justify-center items-center" >
                <AnimationXS />
            </div>

        </div>

        <div  class="col-span-10 border-r text-xs px-4">
            
            <div class="text-2xl font-bold text-gray-700">
                {{ tache.nom }}
            </div>
            <div class="py-4">
                <div class="py-2">
                    <span class="font-sm text-gray-700 font-bold">Date du jour :</span>
                    <span class="ml-2">{{moment(timesheetData.date_jour).format('ll') }}</span>
                </div>
                <div class="py-2">
                    <span  class="font-sm text-gray-700 font-bold">Date et heure de debut :</span>
                    <span class="ml-2">{{ moment(timesheetData.date_debut).format('DD-MM-YYYY HH:mm:ss') }}</span>
                </div>
                <div class="py-2">
                    <span  class="font-sm text-gray-700 font-bold">Date et heure de fin :</span>
                    <span class="ml-2">{{ moment(timesheetData.date_fin).format('DD-MM-YYYY HH:mm:ss') }}</span>
                </div>
                <div class="py-2">
                    <span  class="font-sm text-gray-700 font-bold">Total heure : </span>
                    <span>{{ calculHeure(timesheetData.date_fin,timesheetData.date_debut) }} heures</span>
                </div>
            </div>
            <div  v-html="timesheetData.description" class="px-2 py-4 text-sm justify-center"></div>
    
            <div class="py-4 border-t">
                <span class="text-lg font-bold py-2" >Discussions ( {{ timesheetData.commentaires ? timesheetData.commentaires.length : 0  }} )</span>
                <div class="mt-4">
                    <div class="px-4">
                        <div v-for="commentaire in timesheetData.commentaires" class="shadow-sm p-4 m-2 grid grid-cols-12">
                            <div class=" col-span-1">
                                
                                <img  :src="profil +commentaire.username +'+'+commentaire.username" class="w-8 h-8 rounded-full bg-gray-100" alt="Avatar">
                        
                            </div>
                            <div class="text-xs ml-4 col-span-10">
                                <p>{{ commentaire.commentaire }}</p>
                            </div>
                            <div class="text-xs col-span-12 flex justify-end items-end">
                                    <span class="mt-1"> Il y'a {{formatDate( commentaire.created_at) }}</span>

                                </div>

                            
                        </div>
                    </div>
                    <div class="mt-4">
                        <AjoutCommentaireTimesheet @newComment="setNewComment" :timesheet_id="timesheetData.id"/>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div v-if="modification">
        <TimeSheetForm option="update" :timesheet="timesheetData"  :task="tache" />
    </div>



</template>
<script setup>

import useAxios from '@/ComponentsServices/axios.js'
import moment from 'moment';
import AjoutCommentaireTimesheet from './AjoutCommentaireTimesheet.vue'
import {ref,onMounted} from 'vue'
// import { format, formatDistance, formatRelative } from 'date-fns'
// import { fr } from 'date-fns/locale'
import AnimationXS from '@/Components/AnimationXS.vue';
import Button from '@/Components/Button.vue'
import TimeSheetForm from './TimeSheetForm.vue';

    const props = defineProps({
        timesheet:Object,
        tache:Object
    })
    console.log(props.timesheet);
    const timesheetData = ref()
    const profil = ref('https://ui-avatars.com/api/?name=')
    const ressources = ref([]);
    const modification = ref(false)
    const {axios_post_simple,axios_get  } = useAxios();


    const calculHeure = (date_un,date_deux)=>{
        return Math.floor((new Date(date_un) - new Date(date_deux))/60000)/60
    }
    const setNewComment = (e)=>{
        timesheetData.value.commentaires.push(e)
    }

    const getRessources = ()=>{ 
        
        axios_post_simple('resource-cat-user',{user:props.timesheet.user_id,date:props.timesheet.date_jour}).then(({data})=>{
            ressources.value = data
        }).catch((error)=>{
            console.log(error.response)
        })
    }


    
  
        


   










        const formatDate = (date)=>{
           // return formatDistance( new Date(date), new Date(),{locale:fr})
        }



    onMounted(() => {
        timesheetData.value = props.timesheet
      //  getRessources()
    })


</script>