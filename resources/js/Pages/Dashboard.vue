<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardPresentationTotal from '@/Components/CardPresentationTotal.vue'
import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios';
import useDashBord from '@/ComponentsServices/Dashbord.js'

import AlertNotification from '@/Components/AlertNotification.vue'


const {axios_get} = useAxios()

const {presenceEvent,courrierEvent,audienceEvent} = useDashBord()

const stat_courrier = ref([])
const showNotification = ref(false)
const notification_message = ref('')
const users_connected = ref([])
const getStat_courrier = ()=>{
    axios_get('courrier/statistique').then(({data})=>{
        stat_courrier.value = data
    })
}

onMounted(() => {
    getStat_courrier()

    courrierEvent().listen('CreateCourrierEvent',(event)=>{
        notification_message.value = event.courrier
        showNotification.value = true
        getStat_courrier()
    })
    audienceEvent().listen('CreateAudienceEvent',(event)=>{
        notification_message.value = event.audience
        showNotification.value = true
        //console.log( stat_courrier.value.total_courrier); 
    })


    // window.Echo.private('App.Models.User.1')
    // .notification((notification) => {
    //     console.log(notification);
    //     // notification_message.value = notification.message
    //     // showNotification.value = true
    // });

    presenceEvent().here((users)=>{
            users_connected.value = users
        })
        .joining((user)=>{
            users_connected.value.push(user)
            console.log({user}, 'joind')
        })
        .leaving((user)=>{
            users_connected.value = users_connected.value.filter((u)=> u.id != user.id)
        })

 

})
</script>

<template>
    <Head title="Dashboard" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tableau de Bord</h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-4 gap-4 px-4 py-1">
                    <span class="col-span-2 md:col-span-4 text-xl font-semibold text-gray-700 py-1">Utilisateurs</span>
                    <CardPresentationTotal
                        :total="users_connected ? users_connected.length:0 "
                        title="Utilisateurs Connectes"
                        _className="border-y-blue-700 "
                    />
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 md:grid-cols-4 gap-4 px-4 py-1">
                    <span class="col-span-2 md:col-span-4 text-xl font-semibold text-gray-700 py-1">Statiques Courriers</span>
                    <CardPresentationTotal
                        :total="stat_courrier.total_courriers"
                        title="Total Courriers"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="stat_courrier.total_non_dispatch"
                        title="Courriers Dispatches"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="stat_courrier.total_dispatch"
                        title="Courriers Dispatches"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="stat_courrier.total_en_cours_traitement"
                        title="Courriers en cours traitement"
                        _className="border-y-gray-700 "
                    />
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 md:grid-cols-4 gap-4 px-4 py-1">
                    <span class="col-span-2 md:col-span-4 text-xl font-semibold text-gray-700 py-1">Statiques Audiences</span>
                    <CardPresentationTotal
                        :total="0"
                        title="Total Audience"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="0"
                        title="Audiences Aujourd'hui"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="0"
                        title="Audiences Acceptees"
                        _className="border-y-gray-700 "
                    />
                   
                    <CardPresentationTotal
                        :total="0"
                        title="Audiences en attente rendez vous"
                        _className="border-y-gray-700 "
                    />
                    <CardPresentationTotal
                        :total="0"
                        title="Courriers en cours traitement"
                        _className="border-y-gray-700 "
                    />
                </div>
            </div>
        </div>
        <AlertNotification
            @closeMe="showNotification = false"
            v-if="showNotification"
            :message="notification_message"
        />
    </SideBarLayout>
</template>
