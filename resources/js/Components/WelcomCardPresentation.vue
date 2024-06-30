<template>
    <div class="my-4 py-4 px-2 shadow rounded-xl bg-white">
        <div class="flex">
            <Check class="w-6 h-6 mr-2" />
            <span class="font-semibold text-xl">{{ title }}</span>
        </div>
        <div class="px-6">
            <slot/>
        </div>
    </div>
</template>
<script setup>

import Check from '@/Components/Check.vue';
    const props = defineProps({
        title:String,
      
    })
</script>