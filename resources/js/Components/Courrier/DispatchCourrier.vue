<template>
    <div class="px-6">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div>
                    <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
                    <div class="col-span-1">#</div>
                    <div class="col-span-6">Groupes d'utilisateurs</div>
                </div>
                    <div @click="seletedRoles(r)" v-for="r of roles" :key="r.id" class="w-full p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer">
                        <div class="col-span-1">#</div>
                        <div class="col-span-6">{{r.name }}</div>
                        
                    </div>  
                </div>

            </div>
            <div v-if="currentRole">
                <div>
                    <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
                    <div class="col-span-1">#</div>
                    <div class="col-span-6">Utilisateurs</div>
                </div>
                    <div @click.stop="addCourrierToUser(u,courrier)" v-for="u of currentRole.users" :key="u.id" class="w-full p-3 grid grid-cols-12">
                        <div class="col-span-1">#</div>
                        <div class="col-span-6 w-fit" :class="` ${pickedCourrier.includes(u.id+'__'+courrier.id) ? 'bg-gray-800 text-white' : ''} rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white`">{{u.name }}<Check class='w-4 h-4' v-if="pickedCourrier.includes(u.id+'__'+courrier.id)" /></div>
                        
                    </div>  
                </div>

            </div>




        

        </div>
    </div>
</template>
<script setup>

    import { ref,onMounted } from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import SelectComponent from '@/Components/SelectComponent.vue'
    import Check from '@/Components/Check.vue'
        const props = defineProps({
            courrier:Object
        })
        const {axios_get,axios_post_simple} = useAxios();
        const roles = ref()
        const currentRole = ref()

        const seletedRoles = (role)=>{
            currentRole.value = role

            role.users.forEach(u =>{
                
                u.courriers.forEach(c =>{

                    pickedCourrier.value.push(u.id+'__'+c.id)
                })
            })
        }
        const pickedCourrier = ref([])

        const addCourrierToUser = (user, courrier) =>{
            const key = user.id+'__'+courrier.id

            if(pickedCourrier.value.includes(key)){
                pickedCourrier.value = pickedCourrier.value.filter(k => k != key)
                removeCourrierToUser(user.id, courrier.id)
            }else{
                pickedCourrier.value.push(key)
                setCourrierToUser(user.id,courrier.id)
            }
        }
        const setCourrierToUser = (user, courrier) =>{
            axios_post_simple('courrier/set-courrier-user/'+user, {user,courrier}).then(()=>{
            })
        }
        const removeCourrierToUser = (user, courrier) =>{

            axios_post_simple('courrier/remove-courrier-user/'+user, {user,courrier}).then(()=>{
                
            })
        }

        const getRoles_with_users = ()=>{

            axios_get('role-with-users').then(({data})=>{
                roles.value = data
               
            })
        }

        onMounted(()=>{
            getRoles_with_users()
        })




      

       


// onMounted(()=>{
//    props.users.forEach(u =>{
//        u.roles.forEach(r =>{
//            pickedCourrier.value.push(r.id+'__'+u.id)
//        })
//    })
// })
</script>