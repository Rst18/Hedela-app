<template>
    <div class="max-w-md">
        <NotiticationItem 
            v-for="notification in notifications" 
            :key="notification.id"
            :notification
        />

    </div>
</template>
<script setup>
    import {ref, onMounted} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import NotiticationItem from './NotificationItem.vue'
    const {axios_get} = useAxios()
    const notifications = ref()

    onMounted(() => {
        axios_get('notifications').then(({data})=>notifications.value = data) 
    });

    
</script>