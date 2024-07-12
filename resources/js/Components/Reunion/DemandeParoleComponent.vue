<template>
    <Transition name="slide-fade">
        <div class="relative  w-fit p-4">
            <span @click="close" class="rounded-full border px-2 absolute top-0 right-1 bg-red-700 flex items-center justify-center cursor-pointer hover:bg-red-500 text-slate-800">x</span>
            <div class="mt-4 grid-cols-3">
                <DemandeParoleItem v-for=" d in demandes" :demande="d"/>
            </div>
        </div>
    </Transition>
</template>
<script setup>
    import DemandeParoleItem from './DemandeParoleItem.vue';

    const props = defineProps({
        demandes:Object
    })

    const emit = defineEmits(['closeMe'])

    
    const close = ()=>emit('closeMe')
</script>
<style  scoped>

    .slide-fade-enter-active {
        transition: all 0.3s ease-out;
    }

    .slide-fade-leave-active {
        transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
    }

    .slide-fade-enter-from,

    .slide-fade-leave-to {
        
        transform: translateX(20px);
        opacity: 0;
    }
</style>