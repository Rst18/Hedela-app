<template>
    <div >
        <label for="selectValue" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><slot/></label>
            <select @change="setSelectedValue" v-model="selectedValue" id="selectValue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Choisir une option</option>
            <option v-for="option in options" :value="option.id" :key="option.id">{{ option.name }}</option>
        </select>

    </div>
</template>
<script setup>
import {ref} from 'vue'
    const props= defineProps({
        options:Array
    })
    const emit =defineEmits(['selectedValue']);
    const setSelectedValue = ()=>emit('selectedValue',selectedValue.value)
    const selectedValue = ref()


</script>