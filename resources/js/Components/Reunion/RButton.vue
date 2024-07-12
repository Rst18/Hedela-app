<template>
    <button :class  class="border py-1 px-2 rounded-full cursor-pointer">
        <slot/>
    </button>
</template>
<script setup>
    const props = defineProps({
        class:String
    })
</script>