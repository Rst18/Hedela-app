<template>
  
<div class="flex justify-center items-center" v-if="waitingData">
    <Animation  />
</div>
    
    <div v-else>
        <div class="text-lg text-gray-700 font-semibold">
            Liste taches 
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Nom</div>
           <div class="col-span-7">Description</div>
           <div class="col-span-1">Statut</div>
           <div class="col-span-1">Priorité</div>
       </div>
        <div  @click="getTask(task)" v-for="(task,index) of tasks" :key="task.id" class="w-full text-sm p-3 grid grid-cols-12 border-b cursor-pointer hover:bg-slate-100">
            <div class="col-span-1">{{ index + 1 }}</div>
            <div class="col-span-2">{{task.nom }}</div>
            <div class="col-span-7 px-2 text-xm" v-html="task.description.slice(0,100)+'...'"></div>
            <div class="col-span-1" :class="searchName(statuts,task.statut)[0].color" ><span class="border rounded-full px-2 bg-slate-100">{{ searchName(statuts,task.statut)[0].name }}</span></div>
            <div class="col-span-1" :class="searchName(statuts,task.statut)[0].color" ><span class="border rounded-full px-2 bg-slate-100">{{ searchName(priorites,task.priorite)[0].name }}</span></div>    
        </div>
    </div>


</template>
<script setup>
import useAxios from '@/ComponentsServices/axios.js'   
import {onMounted,ref } from 'vue'
import Animation from '@/Components/Animation.vue';

    const {axios_get} = useAxios();
    const tasks = ref([])
    const emit = defineEmits(['task'])
    const waitingData = ref(true)
    const priorites = [
        {
            id:1,
            name:'Très élevé',
            color:'text-red-600'

        },
        {
            id:2,
            name:'Elevé',
            color:'text-grenn-600'

        },
        {
            id:3,
            name:'Moyen',
            color:'text-gray-600'

        },
        {
            id:4,
            name:'Faible',
            color:'text-slive-600'

        },
    ]
    const statuts = [
        {
            id:1,
            name:'Ouvert',
            color:'text-green-600'

        },
        {
            id:2,
            name:'Fermé',
            color:'text-red-600'

        },
        {
            id:3,
            name:'Suspendu',
            color:'text-gray-600'

        },
    ]

    const searchName = (data,id)=>{
       return data.filter((p)=> p.id == id)
    }
    const getTask = (task)=>{
        emit('task',task)
    }

    onMounted(() =>  axios_get('../user/task').then(({data})=>{ 
        waitingData.value = false
        tasks.value = data.tasks
     }))
        

</script>