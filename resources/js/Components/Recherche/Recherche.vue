<template>

    <div class="relative flex items-center">
        
        <input
            @keypress="emitTexte"
            v-model="texte" 
            type="search"
            class="block w-full rounded border border-gray-300 bg-white px-3 py-2 placeholder-gray-500 focus:outline-none focus:border-blue-500"
            placeholder="Search"
        />
        <span class="absolute right-3">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0a7.5 7.5 0 1 0-10.607 0 7.5 7.5 0 0 0 10.607 0z" />
            </svg>
        </span>
    </div>
    
</template>
<script setup>
    import {ref} from 'vue'

        const emit = defineEmits(['getTexte']);

        const texte = ref()

        const emitTexte = (e)=>{
            if (e.key === 'Enter') {
                emit('getTexte',texte.value)
            }
        }
    
</script>