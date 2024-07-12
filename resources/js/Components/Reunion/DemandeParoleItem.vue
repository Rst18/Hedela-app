<template>
    <div class="max-w-sm border grid grid-cols-1 gap-2 px-6 rounded-xl h-28  py-1 mb-2">
        <div class="py-2 flex justify-center items-center font-bold text-xl text-gray-600">
            {{ demande.name }}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 justify-center items-center text-sm">
            <RButton>Refuser</RButton> 
            <RButton>Accepter</RButton> 
        </div>
    </div>
</template>
<script setup>
    import useAxsios from '@/ComponentsServices/axios.js'
    import RButton from './RButton.vue';
    const props = defineProps({
        demande:Object
    })
    const {axios_post_simple } = useAxsios()
</script>