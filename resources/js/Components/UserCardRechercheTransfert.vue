<template>
    <div class="max-w-xs border p-4 grid grid-cols-1 gap-4 rounded-md hover:shadow-sm hover:border-2">
        <div class="text-sx">
            <span>{{ user.name }}</span>
        </div>
        <div>
            <button @click="add" class="rounded-full border px-2 py-1 text-xs bg-gray-200 text-gray-700 font-bold hover:bg-gray-300">Ajouter</button>
        </div>
      
    </div>
</template>
<script setup>

import useAxios from '@/ComponentsServices/axios.js'
import {ref} from 'vue'

    const props = defineProps({
        user:Object,
        audience_id:Number
    })

    const emit = defineEmits([
        'transfert'
    ])

    const form = ref({
        user_id:props.user.id
    })

    const {axios_post_simple} = useAxios()

    const add = ()=>{

        let audience_id = props.audience_id
        axios_post_simple('../audience/'+audience_id+'/transfert',form.value).then(({data})=>{
            if (data.type==='success') {

                emit('transfert',props.user)
            }
        }).catch((error)=>{
            console.log(error.response);
        })
    }

</script>