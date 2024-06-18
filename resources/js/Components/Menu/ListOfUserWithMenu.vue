<template>
    <form >
       <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Utilisateur</div>
           <div class="col-span-6">menu</div>
           <div class="col-span-2">Date</div>
       </div>
       <div v-if="users[0]">
           <div v-for="u of users" :key="u.name" class="w-full p-3 grid grid-cols-12">
               <div class="col-span-1">#</div>
               <div class="col-span-2">{{u.name }}</div>
               <div class="col-span-6">
                    <div class="flex gap-2 flex-wrap" v-if="menus[0]">
                        <span v-for="r of menus" :key="r.name" @click.stop="addMenuToUser(r,u)" :class="` ${pickedMenu.includes(r.id+'__'+u.id) ? 'bg-gray-800 text-white' : ''} rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`">{{r.name }} <Check class='w-4 h-4' v-if="pickedMenu.includes(r.id+'__'+u.id)" /></span>
                    </div>
               </div>
               <div class="col-span-2">{{ moment(u.updated_at).format('ll') }}</div>
           </div>
       </div>
       <div v-else class="w-full mt-5 p-4 grid place-items-center text-gray-600">
          <span>
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-20 h-20">
                   <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
               </svg>
          </span>
          <p class="text-center mt-4">Pas de données a afficher pour le moment, veuillez creer au moins un menu !  </p>
      </div>
   </form>
</template>
<script setup>
import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'
import useAxios from '@/ComponentsServices/axios.js'
import Check from '../Check.vue';
import Swal from 'sweetalert2';

const { axios_post_simple,axios_post } = useAxios();
import { onMounted, ref } from 'vue';
import moment from 'moment';

 const props = defineProps({
    menus : Array,
    users : Array
 })
 const pickedMenu = ref([])

 const addMenuToUser = (menu, user) =>{
    const key = menu.id+'__'+user.id
    if(pickedMenu.value.includes(key)){
        pickedMenu.value = pickedMenu.value.filter(k => k != key)
        removeMenuToUser(menu.id, user.id)
    }else{
        pickedMenu.value.push(key)
        setMenuToUser(menu.id,user.id)
    }
 }

 const setMenuToUser = (menu, user) =>{
    axios_post('menu/set-menu-user/'+user, {menu,user}).then(()=>{
    })
 }
 const removeMenuToUser = (menu, user) =>{
    axios_post('menu/remove-menu-user/'+user, {menu,user}).then(()=>{
        
    })
 }

 const checkList = ()=>{
  
 }
 onMounted(()=>{
    props.users.forEach(u =>{
        u.menu.forEach(r =>{
            pickedMenu.value.push(r.id+'__'+u.id)
        })
    })
 })
</script>