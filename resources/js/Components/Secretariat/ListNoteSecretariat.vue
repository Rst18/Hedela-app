<template>
    <div >
       <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 text-sm gap-1">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Courrier</div>
           <div class="col-span-2">Sender</div>
           <div class="col-span-5">Lettre</div>
           <div class="col-span-1">Date</div>
           <div class="col-span-1">Status</div>
       </div>
       <div v-if="noteTechniques">
           <div v-for="(note,index) in noteTechniques" :key="note.id" @click="setNote(note)" class="w-full gap-1 mb-1 p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer bg-gray-50 text-sm" >
               <div class="col-span-1 " >{{ index + 1 }}</div>
               <div class="col-span-2">{{note.courrier.number}}</div>
               <div class="col-span-2">{{note.courrier.sender}}</div>
               <div class="col-span-5" :class="!note.lettre ? 'text-red-500':''" v-html="note.lettre ? note.lettre.slice(0,40) +' ...':'Aucune lettre proposee sur cette note technique' "></div>
               <div class="col-span-1">{{ moment(note.created_at).format('ll') }}</div>
               <div class="col-span-1 flex justify-center items-center"  :class="getColorNote(note.status)[0].color"><Check v-if="note.courrier.statut == 4" class="h-4 w-4 text-white border rounded-full bg-green-600 "/></div>
           
            </div>

           <div class="flex flex-row w-full px-4 md:w-9/12 justify-center items-center mx-auto">
             <div v-for="link in links">
                <button class="text-grey-darker text-xs md:text-sm px-1  md:px-2 py-1 m-1 border" @click="fetchNote(link.url)" v-html="link.label"></button>
            </div>
        </div>
       </div>
       <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
          <span>
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
               </svg>
          </span>
          <p class="text-center mt-4">Pas de données ( lettres ) a afficher pour le moment !  </p>
      </div>
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
import UseCourrier from '@/ComponentsServices/Courrier.js'  

    const links = ref([])
    const noteTechniques = ref([]) 
    const {axios_get} = useAxios();
    const emit = defineEmits(['selectedNote'])

    const { getColorNote } = UseCourrier()

    const setNote = (note)=>{
        emit('selectedNote',note)
        // console.log(courrier);
    }

    const fetchNote = (url)=>{
        axios_get('../../'+url).then(({data})=>{
            noteTechniques.value = data.data           
            console.log(data.data);
            links.value = data.links
        }).catch((error)=>{
           console.log(error)
        })
    }

   

    onMounted(() => {
        fetchNote('note-technique/secretariat')
    })

</script>