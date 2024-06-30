<template>
    <div>
        <div class="text-lg  font-semibold">
            Liste des taches
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Group</div>
           <div class="col-span-9">Users</div>
       </div>
        <div v-for="(role,index) of roles" :key="role.d" class="w-full text-sm p-3 grid grid-cols-12 hover:bg-slate-200">
               <div class="col-span-1">{{ index + 1 }}</div>
               <div class="col-span-2">{{role.name }}</div>
               <div class="col-span-9">
                    <div class="flex gap-2 flex-wrap text-xs" >
                        <div v-for="user of role.users" :key="user.id">
                            <span  >
                                {{user.name }} 
                                {{  }}
                            </span>
                            <div class="shadow-sm p-2" >
                                <span class="m-2 text-green-700">Taches</span>
                                <span v-for="task of role.tasks" :key="task.id"
                                    @click.stop="addTaskToUser(user,task)" 
                                    :class="` ${pickedTasks.includes(task.id+'__'+user.id) ? 'bg-gray-800 text-white' : ''} text-xs py-1 rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`"
                                    >{{task.nom }} 
                                    <Check class='w-4 h-4' v-if="pickedTasks.includes(task.id+'__'+user.id)" />
                                </span>
                            </div>
                        </div>
                       
                    </div>
                   
               </div>
        </div>
    </div>
</template>
<script setup>
    import Check from '../Check.vue';
    import {onMounted,ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    const {axios_post_simple} = useAxios()
    const props = defineProps({
        roles:Array
    })

    const pickedTasks = ref([])
    const addTaskToUser= (user, task) =>{

        const key = task.id+'__'+user.id
      
        if(pickedTasks.value.includes(key)){

            pickedTasks.value = pickedTasks.value.filter(k => k != key)
                removetacheToUser(user.id, task.id)
            }else{
                pickedTasks.value.push(key)
                setTacheToUser(user.id,task.id)
            }
    }
    const setTacheToUser = (user, task) =>{
   
        axios_post_simple('set-task-user', {user,task}).then((response)=>{ console.log(response.data);
            
    })
 }
 const removetacheToUser = (user, task) =>{
    axios_post_simple('remove-task-user', {user,task}).then((response)=>{ console.log(response.data);
        
    })
 }
 onMounted(()=>{
    props.roles.forEach(grp =>{
        grp.users.forEach(u =>{
            u.tasks.forEach(t =>{

                pickedTasks.value.push(t.id+'__'+u.id)
            })
        })
    })
 })
</script>