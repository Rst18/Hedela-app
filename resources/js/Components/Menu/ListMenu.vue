<template>
      <div class="flex justify-center items-center" v-if="waitingData">
        <Animation  />
    </div>
   
    <div v-else >
       <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-4">Name</div>
           <div class="col-span-3">Path  </div>
           <div class="col-span-2">Date  </div>
           <div class="col-span-2">Options  </div>
       </div>
       <div v-if="menus">
           <div v-for="m of menus" :key="m.id" class="w-full p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer">
               <div class="col-span-1">#</div>
               <div class="col-span-4">{{m.name }}</div>
               <div class="col-span-3">{{m.path }}</div>
  
               <div class="col-span-2">{{ moment(m.created_at).format('ll') }}</div>
               <div class="col-span-2 grid grid-cols-2 gap-1">
                    <span @click="deleteMenu(m)" class="text-xs font-semibold text-red-600 underline hover:font-bold hover:text-sm">Supprimer</span>
                    <span @click="updateMenu(m)" class="text-xs font-semibold text-blue-600 underline hover:font-bold hover:text-sm">Modifier</span>
               </div>
           </div>
           <div class="flex flex-row w-full px-4 md:w-9/12 justify-center items-center mx-auto">
                <div v-for="link in links">
                    <button class="text-grey-darker text-xs md:text-sm px-1  md:px-2 py-1 m-1 border" @click.prevent="fetchMenu(link.url)" v-html="link.label"></button>
                </div>
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
   </div>
</template>
<script setup>
    import useAxios from '@/ComponentsServices/axios.js'
    import Animation from '@/Components/Animation.vue';
    const { axios_get } = useAxios();
    import { onMounted, ref } from 'vue';
    import moment from 'moment';


    const menus = ref()

    const waitingData = ref(false)
    const emit = defineEmits(['update'])

    const links = ref()
    const fetchMenu = (url)=>{
        waitingData.value = true
        axios_get(url).then(({data:pagination})=>{
            console.log(pagination);
            menus.value = pagination.data           
            links.value = pagination.links
            waitingData.value = false
            
        }).catch((error)=>{
            console.log(error.response)
        })

    }

    const deleteMenu = (menu)=>{

        axios_get('../menu/'+menu.id+'/delete').then(({data})=>{

            if (data.type ==='success') {
                
                menus.value = menus.value.filter((r)=>r.id != menu.id )
            }
        }).catch((error)=>console.log(error.response))
    }

    const updateMenu = (menu)=>{
        emit('update',menu)
    }

    onMounted(() => {
        fetchMenu('../menu/list')
    })

</script>