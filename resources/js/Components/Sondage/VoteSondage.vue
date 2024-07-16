<template>
    <div class="gird grid-cols-1 font-bold text-gray-700 p-2">

        <div>
            {{ sondage.description }}
        </div>
        <div>
            <VoteSondageItem v-for="s in sondage.sondage_items" :sondageItem="s"/>
        </div>
    </div>
</template>
<script setup>
import VoteSondageItem from '@/Components/Sondage/VoteSondageItem.vue'
    const props = defineProps({
        sondage:Object
    })
</script>
