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
        rendezvous_id:Number
    })
    console.log(props.user);

    const emit = defineEmits([
        'userAdded'
    ])

    const form = ref({
        rendezvous:props.rendezvous_id
    })

    const {axios_post_simple} = useAxios()

    const add = ()=>{

        let user_id = props.user.id
        axios_post_simple('../rendezvous/set-rendezvous-user/'+user_id,form.value).then(({data})=>{

            if (data.type==='success') {

                emit('userAdded',props.user)
            }
        }).catch((error)=>{
            console.log(error.response);
        })
    }

</script>