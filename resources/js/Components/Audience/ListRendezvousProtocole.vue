<template>

    <div class="flex justify-center items-center" v-if="waitingData">
        <Animation  />
    </div>
    <div v-else>
       <form >
           <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 text-sm">
               <div class="col-span-1">#</div>
               <div class="col-span-2"> Demandeur </div>
               <div class="col-span-2"> Autorite </div>
               <div class="col-span-4"> Lieu, date et heure du  rendezvous </div>
               <div class="col-span-3"> Accompagnateurs </div>
           </div>
   
          <div v-if="audienceData">
   
               <div v-for="(audience,index) in audienceData" :key="audience.id"  class="w-full mb-1 p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer text-sm">
                   <div class="col-span-1 " >{{ index + 1 }}</div>
                   <div class="col-span-2">{{ audience.name }}</div>
                   <div class="col-span-2">{{ audience.autorite }}</div>
                   <div class="col-span-4 px-2">
                    
                        <div class="grid grid-cols-2 " v-for="rendezvous in audience.rendezvous">
                            <span class="text-xs bg-slate-400 text-gray-700 font-semibold">{{ rendezvous.lieu }}</span>
                            <span class="text-xs bg-green-200 text-gray-700 font-semibold border rounded-full px-2 py-1"> {{ rendezvous.date_heure }}</span>
                        </div>
                   </div>
                   <div class="col-span-3">
                        <div class="grid grid-cols-2 gap-1" v-for="acc in audience.accompagnateurs">
                            <span class="text-xs bg-slate-400 text-gray-700 font-semibold">{{ acc.name }}</span>
                            <span class="text-xs bg-green-200 text-gray-700 font-semibold border rounded-full px-2 py-1">{{ acc.email }}</span>
                        </div>
                   </div>
                  
                </div>
   
              <div class="flex flex-row w-full px-4 md:w-9/12 justify-center items-center mx-auto">
                <div v-for="link in links">
                   <button class="text-grey-darker text-xs md:text-sm px-1  md:px-2 py-1 m-1 border" @click.prevent="fetchAudience(link.url)" v-html="link.label"></button>
               </div>
           </div>
          </div>
          <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
             <span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                  </svg>
             </span>
             <p class="text-center mt-4">Aucun rendez vous prevu aujourdhui</p>
         </div>
      </form>

    </div>
</template>
<script setup>
import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import Check from '../Check.vue';
import Swal from 'sweetalert2';
const { axios_post_simple,axios_post } = useAxios ();
import { onMounted, ref } from 'vue';
import moment from 'moment';
import UseAudience from '@/ComponentsServices/Audience.js'  

import Animation from '@/Components/Animation.vue';

    const links = ref([])
    const audienceData = ref() 
    const {axios_get} = useAxios();
    const props = defineProps({path:String})
    const emit = defineEmits(['selectedAudience','new'])
   
    const { statut_audience,get_status } = UseAudience()

    const setAudience = (courrier)=>{
        emit('selectedAudience',courrier)
    }
    const create = ()=>emit('new')
    const waitingData = ref(true)


    const fetchAudience = (url)=>{
        axios_get(url).then(({data:pagination})=>{
           audienceData.value = pagination.data           
            links.value = pagination.links
            waitingData.value = false
        }).catch((error)=>{
            console.log(error.response)
        })
    }

   

    onMounted(() => {
        fetchAudience('../rendezvous/list')
    })

</script>