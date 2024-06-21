<template>
    <div>
        <div class="text-lg  font-semibold">
            Lite des taches
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 border-l border-r">
          
           <div class="col-span-2 font-bold">Nom</div>
           <div class="col-span-7">Description</div>
       </div>
        <div  @click="emitId(tache.id)" v-for="tache of taches" :key="tache.id" class="w-full text-sm p-3 grid grid-cols-12 border-b hover:bg-gray-200 cursor-pointer">
               
               <div class="col-span-2">{{tache.nom }}</div>
               <div class="col-span-10" v-html="tache.description.slice(0,100)+'...'"></div>
              
        </div>
    </div>
</template>
<script setup>
import { FwbButton } from 'flowbite-vue'
    const props = defineProps({
        taches:Array
    })
    const emit = defineEmits(['getTache'])

    const emitId = (e)=>{emit('getTache',e)}
</script>