<template>
    <div class="grid grid-cols-4 gap-2 py-2">
        <RButton @click="close" >Retour</RButton>
        <a :href="'../reunion/'+ reunion.id.replaceAll('/','++')+'/join'"><RButton v-if="reunion.status == 1"  >Rejoindre la reunion</RButton></a>

    </div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9  p-8 ">
            <AideMemoire v-if="addAideMemoire" :reunion/>
            <div>
               <DetailsRenionComponent :reunion/>
            </div>
        </div>
        <!-- <div class="col-span-3 grid grid-cols-1  gap-4 p-4 h-96 fixed right-14 w-64 rounded-xl border shadow-md">
            <OptionsComponent  :reunion :is_Admin="0"/>
        </div> -->
    </div>
</template>


<script setup>

    import AideMemoire from './AideMemoire.vue';
    import {ref} from 'vue'
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
        const close = ()=>{
            emit('closeMe')
        }

        const demanderParole = ()=>{

            axios_post_simple('../reunion/demande-parole/send',{reunion_id:props.reunion.id}).then(({data})=>{
                console.log(data);
            })
        }

</script>
