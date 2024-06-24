
<template>
    <!-- <Head title="Gestion des taches" /> -->
    <SideBarLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
               <ListRolepWithUsersTasks  :roles/>
            </div>
           

          
        </div>
    </SideBarLayout>
</template>


<script setup>
    import SideBarLayout from '@/Layouts/SideBarLayout.vue';
    // import { Head } from '@inertiajs/inertia-vue3';
    import ListRolepWithUsersTasks from '@/Components/Tache/ListRoleWithUsersTaks.vue'
        const props = defineProps({ 
            roles:Array
        })
</script>
