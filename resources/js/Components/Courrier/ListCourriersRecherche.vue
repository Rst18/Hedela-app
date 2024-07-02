<template>
   
    <div >
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
            <div class="col-span-1">#</div>
            <div class="col-span-2">Ref</div>
            <div class="col-span-1">Type</div>
            <div class="col-span-2">Sender</div>
            <div class="col-span-4">Objet</div>
            <div class="col-span-1">Date  </div>
            <div class="col-span-1">Statut</div>
        </div>
        <div v-if="courriers">
            <div v-for="(courrier,index) in courriers" :key="courrier.id" @click="setCourrier(courrier)" class="text-xs w-full mb-1 p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer" >
                <div class="col-span-1 " >{{ index + 1 }}</div>
                <div class="col-span-2">{{courrier.number}}</div>
                <div class="col-span-1">{{courrier.type_courrier_name}}</div>
                <div class="col-span-2">{{courrier.sender}}</div>
                <div class="col-span-4">{{courrier.objet}}</div>
                <div class="col-span-1 text-xs">{{ moment(courrier.created_at).format('ll') }}</div>
                <div class="col-span-1 flex justify-center items-center":class="getColorCourrier(courrier.status)[0].color"><Check v-if="courrier.status == 4" class="h-4 w-4 text-white border rounded-full bg-green-600 "/></div>
            </div>

        </div>
        <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                </svg>
            </span>
            <p class="text-center mt-4">Aucune donnees trouvees </p>
        </div>
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

    const props = defineProps({
        courriers:Object
    })

    const setCourrier = (courrier)=>{
        emit('selectedCourrier',courrier)
    }


</script>