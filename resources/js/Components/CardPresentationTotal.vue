<template>
    <div :class=" !total ? 'animate-pulse':'' ">
        <div  :class="_className" class="w-full  sm:w-52 h-20 border mx-4 my-2 flex flex-col-reverse rounded-md border-b-2 shadow-md">
            <div class="h-3/4 flex flex-col justify-center items-start pl-2 ">
                <span class="text-xl font-semibold">{{ total }}</span>
                <span class="text-xs ">{{ title }}</span>
            </div>
            <div class="h-1/4 ">
                <!-- <BookOpenIcon class="h-8 w-7 pl-2"/> -->
            </div>
        </div>

    </div>
</template>
<script setup>
    const props = defineProps({
        total:Number,
        _className:String,
        title:String
    })

</script>