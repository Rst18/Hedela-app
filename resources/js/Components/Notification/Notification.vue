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
    const baseUrl =  import.meta.env.VITE_APP_URL
    onMounted(() => {
        axios_get(`${baseUrl}/notifications`).then(({data})=>notifications.value = data) 
    });

    
</script>