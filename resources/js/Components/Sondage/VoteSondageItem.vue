<template>
    <div class="grid grid-cols-1 gap-1 p-4 text-xs border-b">
        <div class="grid grid-cols-1 gap-1">
            <span > {{ sondageItem.description }}</span>
            <fwb-progress
                :progress="50"
                label-position="inside"
                label-progress
                size="sm"
            />
        </div>
        <div class="flex justify-end items-end">
            <RButton class="bg-green-600 text-white " @click="voter">Je vote</RButton>
        </div>
    </div>
</template>
<script setup>
import RButton from '@/Components/Reunion/RButton.vue'
import { FwbProgress } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios';
    const props = defineProps({
        sondageItem:Object
    })
    const {axios_post_simple} = useAxios();

    const voter = ()=>{
        axios_post_simple('../../sondage-item/add-vote',{sondage_item:props.sondageItem.id}).then(({data})=>{
            console.log(data)
        })
    }
</script>
