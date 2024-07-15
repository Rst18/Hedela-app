<template>
    <div class="grid grid-cols-4 gap-2 py-2">
        <a href="../../reunion/list-page"> <RButton v-if="reunion.status !== 2" class="bg-red-700 text-white" >Quitter la reunion</RButton></a>
       
    </div>
    <div class="relative grid grid-cols-12 gap-4">
        <div class="col-span-3 grid grid-cols-1  gap-4 p-4 rounded-r-2xl   border shadow-md">
            <OptionsComponent @showAidesMemoire="addAideMemoire = true"  :reunion :is_Admin="0"/>
        </div>
        <div class="col-span-7 border  rounded-2xl  p-8 shadow-md">
            
            <div>
               <DetailsRenionComponent :reunion/>
            </div>
        </div>
        <div class="col-span-2 border rounded-l-2xl px-4 py-2">
            <!-- <OptionsComponent  :reunion :is_Admin="0"/> -->
             <span class="text-md font-semibold text-gray-700 ">Utilisateurs Connectes </span>
             <div v-for="u in users_connected" :key="u.id" class="text-xs px-2 py-1 mt-1 hover:cursor-pointer hover:bg-gray-100 ">
                <span>{{ u.name }}</span>
                <button class="bg-green-300 h-2 w-2 rounded-full ml-1"></button>
             </div>
        </div>
        
    </div>
    <div v-if="addAideMemoire" class="absolute right-0 bottom-10 w-96 z-50 bg-gray-50">
        <AideMemoire @hideMe="addAideMemoire = false" :reunion/>
    </div>
</template>


<script setup>

    import AideMemoire from './AideMemoire.vue';
    import {ref,onMounted} from 'vue'
    import useAxios from '@/ComponentsServices/axios';
    import DetailsRenionComponent from './DetailsRenionComponent.vue';
    import OptionsComponent from './OptionsComponent.vue';
    import RButton from './RButton.vue';
        const props = defineProps({
            reunion:Object
        })
        const {axios_post_simple} = useAxios()
        const emit = defineEmits(['closeMe'])
        const addAideMemoire = ref(false)
        const users_connected = ref([])
        const close = ()=>{
            emit('closeMe')
        }

        const demanderParole = ()=>{

            axios_post_simple('../reunion/demande-parole/send',{reunion_id:props.reunion.id}).then(({data})=>{
                console.log(data);
            })
        }

        const presenceEvent = (reunionId)=>{
            window.Echo.join(`reunion.${reunionId}`)
            .here((users)=>{
                users_connected.value = users
            })
            .joining((user)=>{
                users_connected.value.push(user)
            })
            .leaving((user)=>{
                users_connected.value = users_connected.value.filter( u => u.email != user.email)
            })
        }

        const aideMemoire = (reunion_id)=>{

            window.Echo.channel(`reunion-${reunion_id}`)

                .listen('AideMemoireSent', (e) => {
                    console.log(e);
                    // Ajoutez le message au DOM
                });
        }


        onMounted(() => {
            presenceEvent(props.reunion.id.replaceAll('/','-'))
            aideMemoire(props.reunion.id.replaceAll('/','-'))
        })

</script>