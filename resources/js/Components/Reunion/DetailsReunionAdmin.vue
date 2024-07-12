<template>
    <div>
        <button @click="close">Retour</button>
    </div>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-9  p-8 ">
            <AidesMemoireList :aides_memoire="reunion.aides_memoire" v-if="showAideM" @closeMe="showAideM = false"/>
            <div>
               <DetailsRenionComponent :reunion/>
            </div>
        </div>
        <div class="col-span-3 grid grid-cols-1  gap-4 p-4 h-fit  rounded-xl border shadow-md">
            <OptionsComponent @showAidesMemoire="showAideM = true" :reunion :is_Admin="1"/>
        </div>
    </div>
</template>


<script setup>
    import AidesMemoireList from './AidesMemoireList.vue';
    import DetailsRenionComponent from './DetailsRenionComponent.vue';
    import OptionsComponent from './OptionsComponent.vue';
   
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios';
        const props = defineProps({
            reunion:Object
        })
        const {axios_post_simple} = useAxios()
        const emit = defineEmits(['closeMe'])
        const addAideMemoire = ref(false)
        const close = ()=>{
            emit('closeMe')
        }
        const showAideM = ref(false)


</script>