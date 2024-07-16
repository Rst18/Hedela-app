<template>
    <div class="h-screen w-screen flex justify-center items-center">
        <div class="flex flex-col justify-center items-center">
            <span class="text-4xl py-6">Error</span>
            <p>{{ message }}</p>
        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        message:String
    })
</script>