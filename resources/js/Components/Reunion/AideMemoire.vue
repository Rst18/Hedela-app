<template>
    <div class="max-w-sm border p-2 rounded-xl">
        <span class="border rounded-2xl px-1 bg-red-700 text-white text-end cursor-pointer" @click="close">X</span>
        <div class="text-xs p-4 bg-white">
            <div v-for="m in messages" :key="m.id" class="grid grid-cols-1 mb-4 border-b">
                <p class="text-sm">
                    {{ m.message }}
                </p>
                <span class="text-end font-semibold">{{ moment(m.created_at).fromNow() }}</span>
            </div>
        </div>
        <div class="col-span-2">
            <fwb-textarea
                v-model="form.message"
                placeholder="Message"
                :rows="2"
                label="Saisir Aide memoire"
            />
            <div class="text-red-500 text-xs py-2" v-if="errors.message">
                {{ errors.message[0]}}
            </div>
        </div>
        <div class="col-span-2  flex justify-end items-end">
            <Fwb-button @click="send" class="bg-gray-800 hover:bg-slate-700 p-1 mt-2">
                Envoyer
            </Fwb-button>
        </div>
    </div>
</template>
<script setup>

import useAxios from '@/ComponentsServices/axios';
import {ref,onMounted} from 'vue'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import moment from 'moment';
    const props = defineProps({
        reunion:Object
    })
    const {axios_post_simple,axios_get} = useAxios()
    const messages = ref()
    const emit = defineEmits(['hideMe'])
    const form = ref({
        reunion_id:props.reunion.id,
        message:''
    })

    const errors = ref([])

    const close = ()=>{emit('hideMe')}
    const send = ()=>{
        axios_post_simple('../../aide-memoire/add',form.value).then(({data})=>{
            console.log(data);
            if(data.type ==='success'){

                messages.value.push(data.new)
                form.value.message = ''
            }
        })
    }
    const getAideMemoire = ()=>{
        axios_post_simple(`../../reunion/aide-memoire`,{reunion_id:props.reunion.id}).then(({data})=>{
            messages.value = data[0].aides_memoire
            console.log(data[0].aides_memoire);
        })
    }

    onMounted(() => {
        getAideMemoire()
    })
</script>