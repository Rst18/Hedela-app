<template>
    <div class="grid grid-cols-3">
        <div v-show="showComponent == 0" class="col-span-2 grid grid-cols-2 gap-2 p-6 ">

            <span @click="close" class="text-xs border w-fit bg-red-600 font-semibold text-slate-100 cursor-pointer py-1 px-2 rounded-full col-span-2 ">Retour</span>
            <span class="text-xl font-semibold text-gray-600 col-span-2 py-4">Details de l'audience </span>
            <div class="grid grid-cols-1 ">
                <span class="font-semibold text-gray-400">Demandeur</span>
                <span>{{ audienceData.name }}</span>
            </div>
            <div  class="grid grid-cols-1 ">
                <span class="font-semibold text-gray-400">Autorité solicite</span>
                <span>{{ audienceData.autorite }}</span>
            </div>
            <div  class="grid grid-cols-1">
                <span class="font-semibold text-gray-400">Motif</span>
                <p>{{ audienceData.autorite }}</p>
            </div>
            <div  class="grid grid-cols-1">
                <span class="font-semibold text-gray-400">Date</span>
                <p>{{ audienceData.date_proposition }}</p>
            </div>
            <div  class="col-span-2 grid grid-cols-">
                <span class="font-semibold text-gray-400">Statut </span>
                <span>{{ get_status(audienceData.status).name }}</span>
            </div>
            <Fwb-button v-if="audienceData.status != 4 && audienceData.status != 1" class="bg-green-700" @click="showComponent = 1" >
               Programmer un  Rendez vous
            </Fwb-button>
            <Fwb-button @click="showComponent = 3" v-if="audienceData.status === 1" class="bg-gray-800" >
            Transferer
            </Fwb-button>
            <Fwb-button @click="CloseAudience" v-if="audienceData.status == 2 " class="bg-red-600" >
                Cloturer
            </Fwb-button>
            
        </div>
        <div class="col-span-2" v-if="showComponent == 1">
            <RendezvousForm option="add" @added="refreshRendezvousList" @closeMe="showComponent = 0" :audience_id="audience.id" :rendezvous/>
        </div>
        <div  :class="showComponent ? 'col-span-3':'col-span-2'" v-if="showComponent == 2">
            <DetailsRendezvous @closeMe="showComponent = 0"  :audience_id="audience.id" :rendezvous="currentRendezvous"/>
        </div>
        <div  :class="showComponent ? 'col-span-3':'col-span-2'" v-if="showComponent == 3">
            <TransfertAudience @closeMe="close"  :audience_id="audience.id" :rendezvous="currentRendezvous"/>
        </div>
        <div v-show="showComponent == 0" class="col-span-1 text-sm mt-6 border-l pl-4 ">
            <span class="py-6 font-semibold text-gray-600 text-lg">Rendez-vous ({{ audienceData.rendezvous.length }})</span>
            <div class="grid grid-cols-12 gap-2 mt-4 bg-slate-100 px-4 py-2">
                <span class="col-span-1" >#</span>
                <span class="col-span-5" >Lieu</span>
                <span class="col-span-5">Heure et date</span>
            </div>
            <div @click ="get_rendezvous(r)" v-for="(r,i) in audienceData.rendezvous" class="py-2 hover:bg-gray-100 hover:cursor-pointer">
               
                <div class="grid grid-cols-12 gap-6 px-4">
                    <span class="col-span-1"  >{{ i + 1 }}</span>
                    <span class="col-span-5"  >{{ r.lieu }}</span>
                    <span class="col-span-5" > {{ r.date_heure }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

    import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea } from 'flowbite-vue'
    import Check from '@/Components/Check.vue'
    import UseAudience from '@/ComponentsServices/Audience.js'
    import RendezvousForm from '@/Components/Audience/RendezvousForm.vue'
    import {ref} from 'vue'
    import DetailsRendezvous from '@/Components/Audience/DetailsRendezvous.vue'
    import TransfertAudience from '@/Components/Audience/TransfertAudience.vue'
    import useAxios from '@/ComponentsServices/axios.js'

        const props = defineProps({
            audience:Object
        })
        const emit = defineEmits(['closeMe','audienceClosed'])
        const { axios_post_simple,axios_get } = useAxios()

        const audienceData = ref(props.audience)
        const rendezvous = ref({})
        const create_rendezvous = ref(false)
        const showComponent = ref(0)
        const currentRendezvous = ref({})

        const { get_status,statut_audience } = UseAudience();
        const close = ()=>emit('closeMe')

        const CloseAudience = ()=>{
            let id = props.audience.id
            axios_post_simple('../audience/close/'+id).then(({data})=>{
                console.log(data);
                if (data.type ==='success') {
                    emit('closeMe')
                }
            })
        }
        const refreshRendezvousList = (e)=>{
            audienceData.value.rendezvous.push(e)
            showComponent.value = 0
        }

        const get_rendezvous = (e)=>{
            currentRendezvous.value = e
            showComponent.value = 2
        }

</script>