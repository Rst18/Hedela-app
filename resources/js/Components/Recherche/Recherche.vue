<template>
    <div>
        <input class="rounded-full" placeholder="Recherche" @keypress="emitTexte" v-model="texte" type="search" name="" id="">
        <div>

        </div>
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