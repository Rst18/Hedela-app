

<template>
    <Head title="Roles" />

    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Recherche</h2>
        </template>

        <div class="py-12">
            <div class="grid grid-cols-1">
                <Recherche @getTexte="search"/>
                <ListCourriersRecherche v-if="!hideListCourrier" :courriers="result" @selectedCourrier="getCurrentCourrier"/>
                
                 <DetailsCourrierProtocole :courrier="currentCourrier" v-else  @closeMe="hideListCourrier = !hideListCourrier" />
            </div>
            
              
        </div>
    </SideBarLayout>
</template>
<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref,onMounted} from 'vue'
import Recherche from '@/Components/Recherche/Recherche.vue'
import useAxios from '@/ComponentsServices/axios.js'
import ListCourriersRecherche from '@/Components/Courrier/ListCourriersRecherche.vue'
import DetailsCourrierProtocole from '@/Components/Courrier/DetailsCourrierProtocole.vue'

    const {axios_post_simple} = useAxios();

    const result = ref()
    const currentCourrier = ref()
    const hideListCourrier = ref(false)
    const search = (e)=>{
        result.value = ''
        axios_post_simple('../courrier/search',{texte:e}).then(({data})=>{
            console.log(data);
            result.value = data
        })
       
    }
    const getCurrentCourrier = (e)=>{
        currentCourrier.value = e
         hideListCourrier.value = true
    }
</script>
