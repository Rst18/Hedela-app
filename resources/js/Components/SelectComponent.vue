<template>
    <div class=""> 
        <label :for="label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><slot/></label>
        <select v-model="selected" @change="emitSelectedOption"  :id="label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choisir...</option>
            <option  v-for="option in options" :key="option.id" :value="option.id">{{ option.name }}</option>
        </select>

    </div>
</template>
<script setup>
import {ref} from 'vue'
    const emit = defineEmits(['selectedOption'])
    const props = defineProps({
        options:Object,
        label:String
    })

    const selected = ref()

    const emitSelectedOption = ()=>{
        emit('selectedOption',selected.value)
    }

    
</script>