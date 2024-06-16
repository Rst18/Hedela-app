<template>
    <div>
        <div class="text-lg  font-semibold">
            Lite des taches
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Group</div>
           <div class="col-span-9">Users</div>
           <!-- <div class="col-span-2">#</div> -->
       </div>
        <div v-for="(group,index) of groups" :key="group.Id" class="w-full text-sm p-3 grid grid-cols-12 border">
               <div class="col-span-1">{{ index + 1 }}</div>
               <div class="col-span-2">{{group.Id }}</div>
               <!-- <div class="col-span-2" v-html="tache.description"></div> -->
               <div class="col-span-9">
                    <div class="flex gap-2 flex-wrap text-xs" >
                        <div v-for="user of group.users" :key="user.id">
                            <span  >
                                {{user.username }} 
                            </span>
                            <div >
                                <span class="m-2">Taches</span>
                                <span v-for="tache in group.taches"  
                                    @click.stop="setTacheToGroup(user.id,tache.id)" 
                                     class="rounded-md border px-2 cursor-pointer"
                                     :class="` ${user.taches.includes((t)=> t.id == tache.id)  ? 'bg-gray-800 text-white' : 'text-red-600'} rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`"
                                      >
                                    {{tache.nom }} {{ user.taches.includes((t)=> t.id == tache.id) }}
                                </span>
                            </div>
                        </div>
                       
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
    const setTacheToGroup = (user, tache) =>{
   
        axios_post_simple('set-tache-user', {user,tache}).then((response)=>{ console.log(response.data);
            
    })
 }
 const removetacheToUser = (user, tache) =>{
    axios_post_simple('remove-tache-user', {user,tache}).then((response)=>{ console.log(response.data);
        
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