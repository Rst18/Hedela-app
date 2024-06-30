
<template>
    <!-- <Head title="Gestion des tâches" /> -->
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tableau de bord
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="  grid grid-cols-5 gap-4 ">
                    <CardPresentationTotal
                        :total="statistic.total"
                        title="Total Taches"
                        _className="border-y-gray-700 "
                        icon="BookOpenIcon"
                    />
                    
                    <CardPresentationTotal
                        :total="statistic.ouvertes"
                        title="Tâches Ouvertes"
                        _className="border-y-green-700 "
                    />
                    <CardPresentationTotal
                        :total="statistic.fermees"
                        title="Tâches Fermées"
                        _className="border-y-red-700 "
                    />
                    <CardPresentationTotal
                        :total="statistic.suspendues"
                        title="Tâches Suspendues"
                        _className="border-y-yellow-300 "
                    />

                </div>
            </div>
        </div>
    </SideBarLayout>
</template>


<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    // import { Head } from '@inertiajs/inertia-vue3';
    import CardPresentationTotal from '@/Components/CardPresentationTotal.vue';
    import useAxios from '@/ComponentsServices/axios.js'
    import {ref,onMounted} from 'vue'

        const { axios_get } = useAxios();

        const statistic = ref({})

        onMounted(() => {
            axios_get('../statistic/task').then(({data})=>{
                statistic.value = data  
            })  

            console.log(statistic.value)
        })




</script>
