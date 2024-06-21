<template>
    <div >
        <div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commentaire</label>
            <textarea v-model="form.commentaire" id="message" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ecrivez votre commentaire ici..."></textarea>
        </div>
        <div class="py-2">
            <fwb-button @click="save" class="rounded-lg mt-2 bg-gray-800 hover:bg-gray-200 hover:dark:bg-gray-600 border">
                Commenter
            </fwb-button>
        </div>
        
    </div>
</template>
<script setup>

    import useAxios from '@/ComponentsServices/axios.js'
    
    import {FwbButton } from 'flowbite-vue'
    // import Button from '@/Components/Button.vue'
    import {ref} from 'vue'


        const props = defineProps({
            task_id:Number
        })
        const emit = defineEmits(['new'])

        const {axios_post_simple} = useAxios()

        const form = ref({
            task_id:props.task_id,
            commentaire:''
        })

        const save = ()=>{
            axios_post_simple('taks/comment/add',form.value).then(({data})=>{
                console.log(data);
                emit('new',data.new)
            }).catch((error)=>{
                console.log(error.response);
            })
        }

</script>