<template>
   <div >
        <a
            href="#"
            class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600"
        >
            <div class="flex-shrink-0">
                <img
                    class="w-11 h-11 rounded-full"
                    :src="profil +$page.props.auth.user.name"
                    alt="img"
                />
             
            </div>
            <div class="pl-3 w-full">
                <div
                    class="text-gray-500 font-normal text-xs mb-1.5 dark:text-gray-400"
                >
                   <span class="block">{{ notification.data.type_notification }}</span>
                    <span
                        class="font-semibold text-gray-900 dark:text-white"
                        >{{ $page.props.auth.user.name }},</span
                    >
                    {{ notification.data.message }}
                </div>
                <div
                    class="text-xs font-medium text-primary-600 dark:text-primary-500"
                >
                    {{ moment(notification.created_at).fromNow() }}
                </div>
            </div>
        </a>
                       
    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import moment from 'moment';

    const profil = ref('https://ui-avatars.com/api/?name=')
    const props = defineProps({
        notification:Object
    })
</script>