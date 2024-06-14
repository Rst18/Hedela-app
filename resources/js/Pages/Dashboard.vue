<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardPresentationTotal from '@/Components/CardPresentationTotal.vue'

import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios';



const {axios_get} = useAxios()
const stat_courrier = ref([])

onMounted(() => {
    axios_get('courrier/statistique').then(({data})=>{
        console.log(data)
        stat_courrier.value = data
    })
})
</script>

<template>
    <Head title="Dashboard" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-4 gap-4 p-4">
                    <span class="col-span-4 text-xl font-semibold text-gray-700 py-4">Statiques Courriers</span>
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-4 gap-4 p-4">
                    <span class="col-span-4 text-xl font-semibold text-gray-700 py-4">Statiques Audiences</span>
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
            </div>
        </div>
    </SideBarLayout>
</template>
