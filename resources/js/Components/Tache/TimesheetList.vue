<template>
    <div v-if="!createTimesheet">
        <div class="flex flex-col py-4 ">
            <div>
                <fwb-button @click="hideMe"  class="rounded-lg mb-2 w-24 bg-blue-600 hover:bg-gray-500 hover:dark:bg-gray-600 border">
                    Retour
                </fwb-button>
                <fwb-button @click="createTimesheet = true"  class="rounded-lg mb-2 w-24 bg-blue-600 hover:bg-gray-500 hover:dark:bg-gray-600 border">
                    Créer
                </fwb-button>

            </div>
            <span class="text-2xl font-bold text-gray-500  ">  {{ task.nom }} </span>
        
        </div>
        <div v-if="task.timesheets">
            <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
               <div class="col-span-1">#</div>
               <div class="col-span-2">Date</div>
               <div class="col-span-7">Description</div>
           </div>
            <div   v-for="timesheet of task.timesheets" :key="timesheet.id" class="w-full text-sm p-3 grid grid-cols-12 border cursor-pointer hover:bg-slate-100">
                   <div class="col-span-1">#</div>
                   <div class="col-span-2">{{ moment(timesheet.date_jourt).format('ll') }}</div>
                   <div class="col-span-7 px-2 text-xm" v-html="timesheet.description"></div>
                  
            </div>

        </div>
        <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600 bg-white rounded-lg border shadow-md">
           <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                </svg>
           </span>
           <p class="text-center mt-4">Pas de données !  </p>
       </div>
    </div>
    <TimeSheetForm v-else="createTimesheet" @hide="createTimesheet = false" :tache_id="tache_id"/>
</template>
<script setup>
import { FwbButton } from 'flowbite-vue'

import useAxios from '@/componentsService/axios.js'   
import {onMounted,ref } from 'vue'
import TimeSheetForm from './TimeSheetForm.vue';
import moment from 'moment';

    const {axios_get} = useAxios();
    const task = ref([])
    const emit = defineEmits(['hide'])
    const props = defineProps  ({tache_id:Number})
    const createTimesheet = ref(false)
    const hideMe = ()=> emit('hide')
   
        onMounted(() => {
            axios_get('task/timesheet/'+props.tache_id).then(({data})=>{
                task.value = data
            })
        })

</script>