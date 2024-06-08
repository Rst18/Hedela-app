<template>
  <div class="antialiased b dark:bg-gray-900">
 
    <NavBar/>
 
   
 
     <!-- Sidebar -->
   <div class="flex">
     <div class="w-64">
       <SideBar/>
     </div>
     <div class="w-full md:w-[calc(100%-260px)]">
       <main class="py-12  ">
         <div>
            <header class="bg-white z-40 sticky top-0 shadow" v-if="$slots.header">
               <div class="mx-auto py-4 mt-4 sm:px-6 lg:px-8">
                   <slot name="header" />
               </div>
           </header>
         </div>
         <div class="overflow-x-scroll h-screen">
            <slot/>
         </div>
        
       </main>
     </div>  
   </div>
  
   </div>
 </template>
 
 <script setup>
 import { onMounted } from 'vue'
 import { initFlowbite } from 'flowbite'
 import NavBar from './Component/NavBar.vue';
 import SideBar from './Component/SideBar.vue';
 
 // initialize components based on data attribute selectors
 onMounted(() => {
     initFlowbite();
 })
 </script>
 