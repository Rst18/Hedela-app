<template>
    <div class="grid grid-cols-4 gap-2 py-2">
        <RButton @click="close">Retour</RButton>
        <RButton v-if="reunion.status !== 2" @click="modification = true" >Modifier la reunion </RButton>
        <RButton v-if="reunion.status !== 2" @click="cloture">Cloturer la reunion </RButton>
        <a :href="'../reunion/'+ reunion.id.replaceAll('/','++')+'/join-admin'"><RButton v-if="reunion.status !== 2" class="bg-blue-600 text-white"  >Rejoindre la reunion</RButton></a>
      
    </div>
    <div class="grid grid-cols-12 gap-4" v-if="!modification">
        <div  class="col-span-9  p-8 ">

            <AidesMemoireList :aides_memoire="reunion.aides_memoire" v-if="showAideM" @closeMe="showAideM = false"/>

            <DemandeParole v-if="showDemandeParole"  :demandes=" reunion.demande_parole" @close-me="showDemandeParole = false"/>
            
            <div>
               <DetailsRenionComponent :reunion/>
            </div>
        </div>
        <div class="col-span-3 grid grid-cols-1  gap-4 p-4 h-fit  rounded-xl border shadow-md">
            <OptionsComponent @showDemandeP="showDemandeParole = true" @showAidesMemoire="showAideM = true" :reunion :is_Admin="1"/>
        </div>

    </div>
    <div v-if="modification">
        <FormCreate action="update" :types :reunion/>
    </div>
</template>


<script setup>
    import AidesMemoireList from './AidesMemoireList.vue';
    import DetailsRenionComponent from './DetailsRenionComponent.vue';
    import OptionsComponent from './OptionsComponent.vue';
    import DemandeParole from './DemandeParoleComponent.vue';
    import FormCreate from './FormCreate.vue';
    import {ref,onMounted} from 'vue'
    import RButton from './RButton.vue';
    import useAxios from '@/ComponentsServices/axios';
    import Swal from 'sweetalert2';  

        const props = defineProps({
            reunion:Object
        })
        const types = ref()
        const {axios_get,axios_post_simple} = useAxios()
        const emit = defineEmits(['closeMe'])
        // const addAideMemoire = ref(false)
        const modification = ref(false)
        const close = ()=>{
            emit('closeMe')
        }
        const showAideM = ref(false)
        const showDemandeParole = ref(false)

        const cloture = ()=>{
            axios_post_simple(`../reunion/clorure`,{reunion:props.reunion.id}).then(({data})=>{

               

                if (data.type === 'success') {

                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('closeMe')
                    })
                    
                }
                Swal.fire(data.type,data.message,data.type)
               
            })
        }

        const get_type = ()=> axios_get('../type-reunion/list-all').then(({data})=>  types.value = data)
            
        

        onMounted(() => get_type())


</script>