<template>
    <div class="grid grid-cols-12 py-2 shadow-sm rounded-sm px-4 gap-2">
        <button class="bg-gray-800 rounded-md py-1 text-gray-50 text-xs font-semibold  col-span-2" v-if="modification == 0" @click="hideMe" >Liste Taches</button>
        <button class="bg-gray-800 rounded-md py-1 text-gray-50 text-xs font-semibold  col-span-2" v-if="modification == 0"  @click="modification = 1">Modifier</button>  
    </div>

    <div v-show="modification == 0">

        <div v-if="!timesheet" class="grid grid-cols-12 mt-4">
            <div  class="col-span-2 border-r text-xs">
                <div class="py-2">
                    <span class="font-bold">Créer par : </span>
                    <span>{{ taskData.firstname }} {{ taskData.lastname }}</span>
                </div>
                <div>
                    <span class="font-bold">Assigner par : </span>
                    <span></span>
                </div>
                <div class="flex  py-2">
                    <span class="font-bold">Statut : </span>
                    <span class="ml-1" :class="searchName(statuts,taskData.statut)[0].color">{{ searchName(statuts,taskData.statut)[0].name }}</span>   
                </div>
                <div class="flex  py-2">
                    <span class="font-bold">Priorité : </span>
                    <span class="ml-1" :class="searchName(priorites,taskData.priorite)[0].color">{{ searchName(priorites,taskData.priorite)[0].name }}</span>   
                </div>
                <div class="flex  py-2">
                    <span class="font-bold">Limite : </span>
                    <span class="ml-1">{{ moment(timesheet.date_limite).format('ll') }}</span>   
                </div>
                <hr>
                <div class="py-2">
                    <span class="py-2 font-bold text-gray-800">Collaborateurs</span>
    
                    <div v-for="user in taskData.users" :key="user.id" class="my-1">
                        <span class="bg-slate-200 font-semibold text-gray-800 px-2 rounded-full text-xs ">{{ user.name }} </span>
                    </div>
                </div>
                <hr>
                <div class="py-2">
                    <span class="py-2 font-bold text-gray-800">Keep Inform</span>
    
                    <div v-for="user in taskData.keep_informed" :key="user.id" class="my-1">
                        <span class="bg-slate-200 font-semibold text-gray-800 px-2 rounded-full ">{{ user.name }}</span>
                    </div>
                </div>
    
            </div>
           
            <div  class="col-span-8 px-4">
                <div class="pb-4">
                    <h1 class="text-2xl font-bold text-gray-700 py-4">{{ taskData.nom }}</h1>
                    <p class="text-sm" v-html="taskData.description"></p>
                   
                </div>
                <div class="py-4 border-t">
                    <span class="text-lg font-bold py-2" >Discussions ( {{ taskData.comments.length  }} )</span>
                    <div class="mt-4">
                        <div class="px-4">
                            <div v-for="comment in taskData.comments" class="shadow-sm p-2 m-2 grid grid-cols-12">
                                <div class=" col-span-1">
                                    <img   :src="profil +comment.firstname +'+'+comment.lastname" class="w-8 h-8 rounded-full bg-gray-100">
                                </div>
                                <div class="text-xs ml-4 col-span-11">
                                    <p>{{ comment.commentaire }}</p>
                                    
                                </div>
                                <div class="text-xs col-span-12 flex justify-end items-end">
                                    <span class="mt-1"> Il y'a {{formatDate( comment.created_at) }}</span>

                                </div>

                                
                               
                            </div>
                        </div>
                        <div class="mt-4">
                            <AjoutCommentaire @new="newComment" :task_id="taskData.id"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2 text-sm border-l px-2">
                <span class="font-bold text-gray-700  border-b">Rapports ( {{ taskData.timesheets.length }} )</span>
                <div @click="getTimesheet(timesheet)"  v-for="timesheet of taskData.timesheets" :key="timesheet.id" class="w-full flex text-xs p-2 cursor-pointer hover:bg-slate-100">
                    <div>{{ timesheet.name  }}   </div>
                    <div class="ml-2">{{   moment(timesheet.date_jourt).format('ll') }}  </div>
                    <!-- <div class="col-span-7 px-2 text-sx" v-html="timesheet.description.slice(0,15)+'...'"></div> -->
                </div>
            </div>
        </div>
        <DetailsTimesheet v-else :tache="taskData" :timesheet="selectedTimesheet"/>
    </div>
         
    <div v-if="modification == 1">
        <FormCreate @updated="hideMe" option="update" :task="task"/>
    </div>
</template>

<script setup>

    import useTimesheet from '@/ComponentsServices/TimeSheet.js' 
    import moment from 'moment';
   import AjoutCommentaire from './AjoutCommentaire.vue';
    import {ref} from 'vue'
    import TimeSheetForm from './TimeSheetForm.vue';
    import FormCreate from '@/Components/Tache/FormCreate.vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import DetailsTimesheet from './DetailsTimesheet.vue';
    // import { format, formatDistance, formatRelative } from 'date-fns'
    // import { fr } from 'date-fns/locale'
    
        const props = defineProps({
            task:Object
        })
        const emit = defineEmits(['hide'])

        const {priorites,statuts} = useTimesheet();
        const {axios_post_simple,axios_get  } = useAxios();
        const modification = ref(0)
        const timesheetForm =ref({})
        const timesheet = ref(false)
        const taskData = ref(props.task)
        const selectedTimesheet = ref({})
        const profil = ref('https://ui-avatars.com/api/?name=')
       




        const searchName = (data,id) => data.filter((p)=> p.id == id)
        
        const getTimesheet =(e)=>{
            selectedTimesheet.value = e
            timesheet.value = true
           
        }
        const newComment =  (e)=>{
            taskData.value.comments.push(e)
        }
       

        const hideMe = ()=>emit('hide')
        const formatDate = (date)=>{
            // return formatDistance( new Date(date), new Date(),{locale:fr})
        }

</script>