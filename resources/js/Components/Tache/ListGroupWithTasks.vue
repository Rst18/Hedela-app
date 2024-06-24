<template>
    <div>
        <div>
        </div>
        <div class="text-lg  font-semibold">
            Liste des Taches
        </div>
        <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
           <div class="col-span-1">#</div>
           <div class="col-span-2">Role</div>
           <div class="col-span-6">Tache</div>
       </div>
        <div v-for="(role,index) of roles" :key="role.id" class="w-full text-sm p-3 grid grid-cols-12 hover:bg-gray-200 ">
               <div class="col-span-1">{{ index + 1 }}</div>
               <div class="col-span-2">{{role.name }}</div>
               <!-- <div class="col-span-2" v-html="task.description"></div> -->
               <div class="col-span-9">
                    <div class="flex gap-2 flex-wrap text-xs" v-if="tasks[0]">
                        <span v-for="task of tasks" :key="task.nom"
                         @click.stop="addTaskToRole(role,task)" 
                         :class="` ${pickedTasks.includes(role.id+'__'+task.id) ? 'bg-gray-800 text-white' : ''} py-1 rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`"
                         >{{task.nom }} 
                          <Check class='w-4 h-4' v-if="pickedTasks.includes(role.id+'__'+task.id)" />
                        </span>
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
        tasks:Array,
        roles:Array
    })

    const pickedTasks = ref([])
    const addTaskToRole = (role, task) =>{

        const key = role.id+'__'+task.id
      
        if(pickedTasks.value.includes(key)){

            pickedTasks.value = pickedTasks.value.filter(k => k != key)
                removetaskToRole(role.id, task.id)
            }else{
                pickedTasks.value.push(key)
                setTaskTorole(role.id,task.id)
            }
    }
    const setTaskTorole = (role, task) =>{
   
        axios_post_simple('set-task-role', {role,task}).then((response)=>{
            
    })
 }
 const removetaskToRole = (role, task) =>{
    axios_post_simple('remove-task-role', {role,task}).then((response)=>{
        
    })
 }
 onMounted(()=>{
    props.roles.forEach(grp =>{
        grp.tasks.forEach(t =>{
            pickedTasks.value.push(grp.id+'__'+t.id)
        })
    })
 })
</script>