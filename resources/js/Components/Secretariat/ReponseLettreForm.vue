<template>
    <div class="border rounded-lg m-2 p-4 "   :class="errors.path ? 'border-red-600':''">
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Message</label>
            <input  class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="text">
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Reponse</label>
            <input @change="getDocument" class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
        </div>
        <div>
            <div v-if="waitingData"  class="w-10 h-10">
                <AnimationXS/>
            </div>
            <Check v-if="uploaded" class="h-6 w-6 font-semibold text-green-600"/>

            <Fwb-button class="text-xs" v-if="!uploaded" @click="save">
                Envoyer
            </Fwb-button>
            <div class="text-red-500 text-xs" v-if="errors.path">
                {{ errors.path[0]}}
           </div>
        </div>
    </div>

</template>
<script setup>
    
    import { FwbButton } from 'flowbite-vue'
    import useAxios from '@/ComponentsServices/axios.js';
    import AnimationXS from '@/Components/AnimationXS.vue';
    import Check from '@/Components/Check.vue';
    import { ref } from 'vue';
    
import Swal from 'sweetalert2';


    const props = defineProps({
        model_id:Number,
       
    });
    const emit = defineEmits(['hideMe'])
    const waitingData = ref(false)
    const uploaded = ref(false)
    const errors = ref([])
    const form = ref({
        message:'',
        response_file:'',
        courrier:props.model_id,
    });

    const {axios_post_simple} = useAxios();

    const save = ()=>{
            waitingData.value = true
            errors.value = []
        axios_post_simple(`../courrier/response/${props.model_id}`,form.value).then(({data})=>{
            console.log(data);
            if (data.type === 'success') {
                
                Swal.fire(data.type,data.message,data.type).then(()=>{

                    waitingData.value = false
                    uploaded.value = true
                    emit('hideMe')
    
                })
            }else {

                Swal.fire(data.type,data.message,data.type)
            }
        }).catch((error)=>{
            if (error.response.status === 422) {
                errors.value = error.response.data.errors
                
            }
             console.log(error.response);
            waitingData.value = false
        })
    }

    const getDocument =(e)=>{

        if(e.target.files[0].size > 5000000){

            alert('Le ficher est trop grand')
            e.target.value = ''
            return

        }else{

            
            form.value.response_file = e.target.files[0]

        } 
    } 



</script>