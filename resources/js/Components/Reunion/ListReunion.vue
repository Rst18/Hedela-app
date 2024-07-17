<template>
    <div class="flex justify-center items-center" v-if="waitingData">
       <Animation  />
   </div>

   <div v-else class="text-xs" >
      <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 gap-1">
          <div class="col-span-1">#</div>
          <div class="col-span-2">Code</div>
          <div class="col-span-5">Description</div>
          <div class="col-span-1">Date</div>
          <div class="col-span-1">Ordre du jour  </div>
          <div class="col-span-1">Orateurs  </div>
          <div class="col-span-1">Options  </div>
      </div>
      <div v-if="reunions">
            <div v-for="r of reunions" :key="r.id" @click="getCurrentReunion(r)" class="w-full p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer">
                <div class="col-span-1">#</div>
                <div class="col-span-2">{{r.id }}</div>
                <div class="col-span-5">{{r.description.slice(0,200)+' ...' }}</div>

                <div class="col-span-1">{{ moment( r.date_debut).format('ll')}}</div>
                <div class="col-span-1">{{ r.ordres_du_jour ? r.ordres_du_jour.length : 0}}</div>
                <div class="col-span-1">{{ r.orateurs?r.orateurs.length : 0}}</div>
                <div class="col-span-1">
                    <Xmark  v-if="r.status == 2" class="w-6 h-6 bg-red-400 text-red-800 border rounded-full"/>
                    <Check v-if="r.status == 1" @click="fermerReunion(r)"  class="w-6 h-6  border rounded-full bg-green-400 text-green-800"/>
                    <Check v-if="r.status == 0" @click="ouvrirReunion(r)" class="w-6 h-6  border rounded-full bg-gray-400 text-gray-800" />
                </div>
            </div>
          <div class="flex flex-row w-full px-4 md:w-9/12 justify-center items-center mx-auto">
               <div v-for="link in links">
                   <button class="text-grey-darker text-xs md:text-sm px-1  md:px-2 py-1 m-1 border" @click.prevent="fetchReunion(link.url)" v-html="link.label"></button>
               </div>
           </div>
      </div>
      <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
         <span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
              </svg>
         </span>
         <p class="text-center mt-4">Pas de données a afficher pour le moment !  </p>
     </div>
  </div>
</template>
<script setup>
   import useAxios from '@/ComponentsServices/axios.js'
   import Animation from '@/Components/Animation.vue';
   import { onMounted, ref } from 'vue';
   import moment from 'moment';
    import Check from '../Check.vue';
    import Xmark from '../Xmark.vue';

   const { axios_get,axios_post_simple } = useAxios();


    const reunions = ref()

    const emit = defineEmits(['currentReunion'])
    const props = defineProps({
        is_Admin:Number
    })

    const getCurrentReunion =(e)=>emit('currentReunion',e)

    const waitingData = ref(false)
    const links = ref()
    const fetchReunion = (url)=>{
        waitingData.value = true
        axios_get(url).then(({data:pagination})=>{
            reunions.value = pagination.data
            links.value = pagination.links
            waitingData.value = false
        }).catch((error)=>{
            console.log(error.response)
        })
    }

    const ouvrirReunion = (reunion)=>{
        if (props.is_Admin === 1) {
            axios_post_simple(`reunion/${reunion.id}/open`).then(({data})=>{

            })

        }
    }
    const fermerReunion = (reunion)=>{
        if (props.is_Admin === 1) {

            axios_post_simple(`reunion/${reunion.id}/close`).then(({data})=>{

            })
        }
    }

    onMounted(() => {
        fetchReunion('../reunion/list')
    })

</script>
