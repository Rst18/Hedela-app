<template>
    <div class="flex justify-center items-center" v-if="waitingData">
       <Animation  />
   </div>
   <div v-else>
       <form >
       <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Numero</div>
           <div class="col-span-2">Expeditaire</div>
           <div class="col-span-2">Date  </div>
           <div class="col-span-3 text-center">Lettre & Ac. Reception  </div>
           <div class="col-span-2">Options</div>
       </div>
       <div v-if="courrierData">
           <div v-for="(courrier,index) in courrierData" :key="courrier.id" class="w-full  mb-1 p-3 grid grid-cols-12 gap-1 hover:bg-slate-200 hover:cursor-pointer text-sm" >
               <div class="col-span-1 " >{{ index + 1 }}</div>
               <div class="col-span-2">{{courrier.number}}</div>
               <div class="col-span-2">{{courrier.requested}}</div>
               <div class="col-span-2">{{ moment(courrier.created_at).format('ll') }}</div>
               <div class="col-span-3 grid  grid-cols-2  px-2">
                    <span>  <a  :href="'../download/'+ courrier.letter_file.replaceAll('/','++')" target="_blank" class="font-bold text-xs hover:underline text-blue-700 ml-4">Lettre</a></span>
                    <span >  <a   :href="'../download/'+ courrier.accuse_reception_file.replaceAll('/','++')" target="_blank" class="font-bold  hover:underline text-xs text-blue-700 ml-4">Accusée de rcpt</a></span>
                </div>
                <div>
                   <span class="hover:border cursor-pointer text-xs  rounded-xl px-2 py-1 bg-gray-300 text-gray-700 " @click="getCourrier(courrier)">Modifier</span>
               </div>
           </div>

           <div class="flex flex-row w-full px-4 md:w-9/12 justify-center items-center mx-auto">
               <div v-for="link in links">
                   <button class="text-grey-darker text-xs md:text-sm px-1  md:px-2 py-1 m-1 border" @click.prevent="fetchCourrier(link.url)" v-html="link.label"></button>
               </div>
           </div>
       </div>
       <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
           <span>
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
               </svg>
           </span>
           <p class="text-center mt-4 ">Pas de données a afficher pour le moment, veuillez creer au moins un document !  </p>
       </div>
       </form>
   </div>
</template>
<script setup>
import useAxios from '@/ComponentsServices/axios.js'
import Check from '../Check.vue';
import { onMounted, ref } from 'vue';
import moment from 'moment';
import UseCourrier from '@/ComponentsServices/Courrier.js'  
import Animation from '@/Components/Animation.vue';

   const links = ref([])
   const courrierData = ref() 
   const {axios_get} = useAxios();
   const emit = defineEmits(['selectedCourrier'])
   const waitingData = ref(true)
   const { courrier_status,getColorCourrier } = UseCourrier()


    const getCourrier = (courrier)=>{
        emit('selectedCourrier',courrier)
    }

    const fetchCourrier = (url)=>{
        axios_get(url).then(({data:pagination})=>{
            courrierData.value = pagination.data           
            links.value = pagination.links
            waitingData.value = false
        }).catch((error)=>{
            console.log(error.response)
        })
    }

  

   onMounted(() => {
      

           fetchCourrier('../courrier-sortant/list')
       
   })

</script>