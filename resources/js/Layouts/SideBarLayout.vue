<template>
  <div class="antialiased  h-screen overflow-hidden dark:bg-gray-900 ">
 
    <NavBar/>
     <!-- Sidebar -->
   <div class="flex ">
      <div class="w-64  hidden md:block">
        <SideBar/>
      </div>
      <div class="w-full md:w-[calc(100%-260px)]">
        <main class="py-12">
          <div>
              <header class="bg-white sticky top-0 shadow" v-if="$slots.header">
                <div class="mx-auto py-4 mt-3 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
          </div>
          <div class="h scroll overflow-auto px-4 md:px-0">
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

 <style  scoped>

    .h{
        height: calc(100vh - 90px);
    }
    .h1{
        height: 10%;
    }
    .h9{
        height: 90%;
    }
    ._h{
        height: calc(100vh - 0px);
    }
    .scroll::-webkit-scrollbar-track
    {
        background-color: rgb(248, 250, 252);
    }
    
    .scroll::-webkit-scrollbar
    {
        width: 5px;
        background-color: #F5F5F5;
    }
    
    .scroll::-webkit-scrollbar-thumb
    {
        background-color: #c9c8c8;
    }
    .scroll::-webkit-scrollbar-thumb:hover
    {
        background-color: #b3b2b2;
    }
 </style>
 