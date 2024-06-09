<template>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">{{ name }}</label>
        <input @change="getDocument" class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
    </div>
    <div>
        <Fwb-button @click="save">
            Enregistrer
        </Fwb-button>
    </div>
</template>
<script setup>
    
import { FwbButton } from 'flowbite-vue'
    import useAxios from '@/ComponentsServices/axios.js';
    import { ref } from 'vue';

    const props = defineProps({
        url:String,
        model_id:Number,
        name:String
    });

    const form = ref({
        name:props.name,
        path:'',
        courrier_id:props.model_id,
        note_technique_id:props.model_id
    });

    const {axios_post_simple} = useAxios();

    const save = ()=>{
        axios_post_simple(props.url,form.value).then((response)=>{
            console.log(response.data)
        }).catch((error)=>console.log(error.response ))
    }

    const getDocument =(e)=>{

        if(e.target.files[0].size > 5000000){

            alert('Le ficher est trop grand')
            e.target.value = ''
            return

        }else{

            
            form.value.path = e.target.files[0]

        } 
    } 



</script>




