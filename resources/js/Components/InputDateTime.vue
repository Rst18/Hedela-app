<template>
    <div>

        <label :for="label"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          <slot/>
        </label>
        <input
            :id="label"
            @change="setInputValue"
            v-model="date_time"
            type="datetime-local"
            name="partydate"
            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        /> 
    </div>
</template>
<script setup >
import {ref} from 'vue'
  
    const props = defineProps({label:String,defaultDate:'' })
    const emit = defineEmits(['inputValue'])
    const date_time = ref(props.defaultDate)
    const setInputValue = ()=> emit('inputValue',date_time.value)
</script>