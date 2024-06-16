<template>
    <div>
        <div>
        </div>
        <div class="text-lg  font-semibold">
            Lite des taches
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Groupe</div>
           <div class="col-span-6">Taches</div>
       </div>
        <div v-for="(group,index) of groups" :key="group.Id" class="w-full text-sm p-3 grid grid-cols-12 border">
               <div class="col-span-1">{{ index + 1 }}</div>
               <div class="col-span-2">{{group.Id }}</div>
               <!-- <div class="col-span-2" v-html="tache.description"></div> -->
               <div class="col-span-9">
                    <div class="flex gap-2 flex-wrap" v-if="taches[0]">
                        <span v-for="tache of taches" :key="tache.nom"
                         @click.stop="addTaskToGroup(group,tache)" 
                         :class="` ${pickedTaches.includes(group.Id+'__'+tache.id) ? 'bg-gray-800 text-white' : ''} rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`"
                         >{{tache.nom }} 
                          <!-- <Check class='w-4 h-4' v-if="pickedTaches.includes(group.id+'__'+tache.id)" /> -->
                        </span>
                    </div>
               </div>
        </div>
    </div>
</template>
<script setup>
    import {onMounted,ref} from 'vue'
    import useAxios from '@/componentsService/axios.js'
    const {axios_post_simple} = useAxios()
    const props = defineProps({
        taches:Array,
        groups:Array
    })

    const pickedTaches = ref([])
    const addTaskToGroup = (group, tache) =>{

        const key = group.Id+'__'+tache.id
      
        if(pickedTaches.value.includes(key)){

            pickedTaches.value = pickedTaches.value.filter(k => k != key)
                removetacheToUser(group.Id, tache.id)
            }else{
                pickedTaches.value.push(key)
                setTacheToGroup(group.Id,tache.id)
            }
    }
    const setTacheToGroup = (group, tache) =>{
   
        axios_post_simple('set-tache-group', {group,tache}).then((response)=>{ console.log(response.data);
            
    })
 }
 const removetacheToUser = (group, tache) =>{
    axios_post_simple('remove-tache-group', {group,tache}).then((response)=>{ console.log(response.data);
        
    })
 }
 onMounted(()=>{
    props.groups.forEach(grp =>{
        grp.taches.forEach(t =>{
            pickedTaches.value.push(grp.Id+'__'+t.id)
        })
    })
 })
</script>