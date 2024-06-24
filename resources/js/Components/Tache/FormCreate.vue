<template>
    <div class="border p-8 w-max-lg m-2">
        <div class="py-2 ">
            <span class="font-bold text-gray-600 text-xl">{{ option === 'add' ?'Créer une Tache':'Modifier la tache' }}</span>
        </div>
        <div class="grid grid-cols-1 gap-2">
            <div>
                <fwb-input
                    v-model="form.nom"
                    placeholder="Ecrire le nom de la tache"
                    label="Nom"
                />
                <div class="text-red-500 text-xs py-1" v-if="errors.nom">
                        {{ errors.nom[0]}}
                </div>
            </div>
            <!-- <div>
                <fwb-input
                    v-model="form.date_limite"
                    placeholder="Date Limite "
                    label="Date Limite"
                    type="date"
                />
                <div class="text-red-500 text-xs py-1" v-if="errors.date_limite">
                        {{ errors.date_limite[0]}}
                </div>
            </div> -->
            <div class="flex gap-2">
                <div class="w-[50%]" >
                    <InputDateTime label="date_debut" :defaultDate="form.date_debut" @inputValue="getDateDebut">
                        Date et heure de Debut
                    </InputDateTime>
                    <div class="text-red-500" v-if="errors.date_debut">
                            {{ errors.date_debut[0]}}
                    </div>
                </div>
                <div class="w-[50%]">
                    <InputDateTime label="date_fin" :defaultDate="form.date_fin"  @inputValue="getDateFin">
                        Date et heure de fin
                    </InputDateTime>
                    <div class="text-red-500" v-if="errors.date_fin">
                        {{ errors.date_fin[0]}}
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <div class="w-[50%]" >
                    <InputDateTime label="date_debut" :defaultDate="form.date_debut" @inputValue="getDateFermeture">
                        Date et heure de Fermeture
                    </InputDateTime>
                    <div class="text-red-500" v-if="errors.date_debut">
                            {{ errors.date_debut[0]}}
                    </div>
                </div>
                <div class="w-[50%]">
                    <SelectComponent :defaultSelectedValue ="form.priorite" :options="type_taches" @selectedValue="getPriorite">
                        Recurence de la tache
                    </SelectComponent>
                </div>
            </div>
            <div class="flex col-2 gap-2 pb-2">
    
                <div class="w-[50%]">
                    <SelectComponent :defaultSelectedValue ="form.priorite" :options="priorites" @selectedValue="getPriorite">
                        Priorité
                    </SelectComponent>
                </div>
                <div class="w-[50%]">
                    <SelectComponent :defaultSelectedValue ="form.statut" :options="statuts" @selectedValue="getStatut">
                        Statut
                    </SelectComponent>
                </div>
            </div>

            <div>
                <EditorComponent v-model="form.description"/>
            </div>
            <div class="py-2">
                <span @click="addUserToTaks = !addUserToTaks" class="font-bold text-xs text-green-600 py-2 rounded-full px-2 cursor-pointer hover:border hover:bg-slate-100">Ajouter Utilisateur</span>
                <div v-show="addUserToTaks">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <div>
                                <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12">
                                <div class="col-span-1">#</div>
                                <div class="col-span-6">Groupes d'utilisateurs</div>
                            </div>
                                <div @click="seletedRole(r)" v-for="r of roles" :key="r.id" class="w-full p-3 grid grid-cols-12 hover:bg-slate-200 hover:cursor-pointer">
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
                                <div @click.stop="addUser(user.id,currentRole.id)" v-for="user of currentRole.users" :key="user.id" class="w-full p-3 grid grid-cols-12">
                                    <div class="col-span-1">#</div>
                                    <div class="col-span-6 w-fit rounded-lg px-1 bg-gray-100 border border-gray-500 flex items-center gap-2 hover:bg-gray-800 cursor-pointer hover:text-white">{{user.name }}</div>
                                    
                                </div>  
                            </div>
                            <div class="text-xs">
                               {{ users.length }} utilisateur(s) ajouté(s)
                            </div>

                        </div>     

                    </div>

                </div>
            </div>
        </div>
        <fwb-button @click="save" class="rounded-lg mt-2 bg-gray-800 hover:bg-gray-700 hover:dark:bg-gray-600 border">
          {{option === 'add' ? 'Enregistrer' :'Modifier'}}
        </fwb-button>

    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import { FwbA, FwbButton, FwbTextarea,FwbInput } from 'flowbite-vue'
    import EditorComponent from '@/Components/EditorComponent.vue'
    import SelectComponent from '@/Components/Tache/SelectComponent.vue'
    import InputDateTime from '@/Components/InputDateTime.vue'
    import Swal from 'sweetalert2';
    import Check from '../Check.vue';

    const {axios_post_simple} = useAxios();
    const emit = defineEmits(['new','updated'])
    const props = defineProps({
        
        option:String,
        task:Object,
        roles:Object
    })
    const errors =ref([]);
    const form = ref({
        nom:props.task.nom,
        description:props.task.description,
        date_limite:props.task.date_limite ? split(props.task.date_limite,' ')[0]:props.task.date_limite,
        statut:props.task.statut,
        priorite:props.task.priorite,
        date_debut:props.task.date_debut,
        date_fin:props.task.date_fin,
        date_fermeture:props.task.date_fermeture,
    })
    
    const getPriorite = (e)=>  form.value.priorite = e
    const getStatut = (e)=>  form.value.statut = e
    const getDateDebut = (e)=>form.value.date_debut = e
    const getDateFin = (e)=>form.value.date_fin = e
    const getDateFermeture = (e)=>form.value.date_fermeture = e
    const currentRole = ref()
    const addUserToTaks = ref(false)
        
    const save = ()=>{
        form.value.users = users.value

        if (props.option === 'add') {
            axios_post_simple('../task-save',form.value).then(({data})=>{
                if (data.type === 'success') {
                    
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('new',data.new)
                        form.value = {}
                        addUserToTaks.value = false
                    })
                }
            }).catch((error)=>{
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors
                }
            })
        }else if(props.option ==='update'){

            axios_post_simple(`task-update/${props.task.id}`,form.value).then(({data})=>{                
                if (data.type ==='success') {
                    Swal.fire(data.type,data.message,data.type).then(()=>{
                        emit('updated')
                        
                    })
                    
                }
            }).catch((error)=>{
                console.log(error.response);
            })
        }
    }
    const check = ref(false)
    const users = ref([])

    const addUser = (user,role)=>{

        if ( users.value.filter((u)=> u.alias ===  user+"__"+role )[0]) {
            users.value = users.value.filter(u=> u.user !== user )
            
        }else{
            users.value.push({ user, role,alias:user+"__"+role  })
            check.value = true
   
        }
    }

    const seletedRole = (role)=>{
        currentRole.value = props.roles.filter((r)=> r.id === role.id)[0]
    }
    

    const priorites = [
        {
            id:1,
            name:'Très élevé'

        },
        {
            id:2,
            name:'Elevé'

        },
        {
            id:3,
            name:'Moyen'

        },
        {
            id:4,
            name:'Faible'

        },
    ]
    const statuts = [
        {
            id:1,
            name:'Ouvert'

        },
        {
            id:2,
            name:'Fermé'

        },
        {
            id:3,
            name:'Suspendu'

        },
    ]

    const type_taches = [
        {
            id:1,
            name:'Journalier'
        },
        {
            id:2,
            name:'Hebdomadaire'
        },
        {
            id:3,
            name:'Mensuel'
        },
    ]
</script>