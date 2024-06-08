<template>
    <div >
        <div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commentaire</label>
            <textarea v-model="form.commentaire" id="message" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ecrivez votre commentaire ici..."></textarea>
        </div>
        <div class="py-2">
            <Button @click="save" class="bg-gray-200 text-gray-700 hover:text-white">Commenter</Button>
        </div>
        
    </div>
</template>
<script setup>

    import useAxios from '@/ComponentsServices/axios.js'
    import Button from '@/Components/Button.vue'
    import {ref} from 'vue'


        const props = defineProps({
            model_id:Number,
            url:String
        })
        const emit = defineEmits(['new'])

        const {axios_post_simple} = useAxios()

        const form = ref({
            courrier_id:props.model_id,
            note_technique_id:props.model_id,
            commentaire:''
        })
        const save = ()=>{
            axios_post_simple(props.url,form.value).then(({data})=>{
                emit('new',data.new)
            }).catch((error)=>{
                console.log(error.response);
            })
        }

</script>