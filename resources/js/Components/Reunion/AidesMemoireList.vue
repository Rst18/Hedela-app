<template>
    <Transition name="slide-fade">
        <div class="relative  w-fit p-4">
            <span @click="close" class="rounded-full border px-2 absolute top-0 right-1 bg-red-700 flex items-center justify-center cursor-pointer hover:bg-red-500 text-red-800">x</span>
            
            <div v-for="a in aides_memoire"  class="max-w-lg grid grid-cols-12 mb-4 mt-8">
                <div class="col-span-1 flex justify-center">
                    <img  :src="profil +a.name +'+'+a.name" class="w-8 h-8 rounded-full bg-gray-50">              
                </div>
                <div class="col-span-11 border rounded-xl p-4 text-sm " >
                    <p class="text-gray-700" >  
                       {{ a.message }}
                    </p>
                    <div class="flex justify-between mt-4 font-bold text-gray-500">
                        <span class="text-xs text-end">{{ a.name }}</span>
                        <span class="text-xs text-end">{{ moment(a.created_at).fromNow() }}</span>
        
                    </div>
                </div>
               
            </div>
    
        </div>
    </Transition>
</template>
<script setup>
    import moment from 'moment';
    import {ref} from 'vue'
    
        const props = defineProps({
            aides_memoire:Object
        })
        const emit = defineEmits(['closeMe'])
        const profil = ref('https://ui-avatars.com/api/?name=')

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