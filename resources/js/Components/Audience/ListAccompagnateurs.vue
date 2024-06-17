<template>
    <div>
           <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 text-sm">
               <div class="col-span-1">#</div>
               <div class="col-span-5"> Name </div>
               <div class="col-span-2"> Email </div>
               <div class="col-span-2"> phone </div>
               <div class="col-span-1"> Option </div>
           </div>
   
          <div>
   
               <div v-for="(accompagnateur,index) in accompagnateurs" :key="accompagnateur.email"  class="w-full mb-1 p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer text-sm">
                   <div class="col-span-1 " >{{ index + 1 }}</div>
                   <div class="col-span-5">{{ accompagnateur.name }}</div>
                   <div class="col-span-2">{{ accompagnateur.email }}</div>
                   <div class="col-span-2">{{ accompagnateur.phone }}</div>
                   <div class="col-span-1"> <span @click="deleteAcc(accompagnateur)">Delete</span></div>
                  
                </div>
   
              
          </div>
    </div>
</template>
<script setup>
    const props = defineProps({accompagnateurs:Object})
    const emit = defineEmits(['delete'])
    const deleteAcc = (e)=>{
        emit('delete',e)
    }
</script>