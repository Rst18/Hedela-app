<template>
    <div class="relative">
        <div class="grid grid-cols-12 py-1 px-6">
            <button v-if="showComponent == 1"  @click="close" class="border w-fit p-1 col-span-2 px-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Liste des courriers</button>
            <button v-if="showComponent == 1"  @click="showComponent = 4" class="border w-fit p-1 px-2 col-span-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Créer Une note technique</button>
            <button v-if="showComponent > 2"  @click="showComponent = 1" class="border w-fit p-1 px-2 col-span-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Details Courrier</button>
        </div>

        <div class="grid grid-cols-12 px-6 gap-2" v-show="showComponent == 1">
            
                <div class="col-span-8">
                    <div class="grid grid-cols-2 gap-2 p-4 mb-2 shadow-md">
                        <div class="col-span-2 text-xl font-bold text-slate-700">
                            Details courrier
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Numero :</span>
                            <span> {{ courrierData.number }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Expeditaire :</span>
                            <span> {{ courrierData.sender }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Email :</span>
                            <span> {{ courrierData.email }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Phone :</span>
                            <span> {{ courrierData.phone }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Type Courrier :</span>
                            <span> {{ courrierData.type_courrier_name }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Objet :</span>
                            <span> {{ courrierData.objet }}</span>
                        </div>
                        <div>
                            <span class="px-2 font-semibold text-slate-500">Numero de la lettre :</span>
                            <span> {{ courrierData.letter_number }}</span>
                        </div>
                        <div class="shadow p-2">
                            <div class="grid grid-cols-1">
                                <span class="px-2 font-semibold text-slate-500">Lettre </span>
                                <a :href="'download/'+ courrierData.letter_file.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-300 ml-4">Imprimer la lettre</a>
                            </div>
                            <div class="grid grid-cols-1">
                                <div>
                                    <span class="px-2 font-semibold text-slate-500">Annexes ({{ courrierData.annexes.length }})</span>
                                    <span class="text-xs font-semibold text-gray-400 underline cursor-pointer" v-if="total_annexes > courrierData.annexes.length" @click="addAnnexes = !addAnnexes">{{ addAnnexes ? 'Ajouter Annexes':'Annuler' }}</span>
                                </div>
                                <div>
                                    <a v-for="annexe in courrierData.annexes" :href="'download/'+ annexe.path.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-700 ml-4"> {{ annexe.name }}</a>
                                    <UploadAnnexes v-if="addAnnexes" v-for="doc in annexes_missed" :key="doc.id"  url="annexe-courrier/add" :model_id="courrierData.id" :name="doc.name"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 shadow-sm border ">
                        <span class="text-lg font-bold py-2" >Discussions ( {{ courrierData.commentaires ? courrierData.commentaires.length : 0  }} )</span>
                        <div class="mt-4">
                            <div class="px-4">
                                <div v-for="commentaire in courrierData.commentaires" class="shadow-sm p-4 m-2 grid grid-cols-12">
                                    <div class=" col-span-1">
                                        
                                        <img  :src="profil +commentaire.name +'+'+commentaire.name" class="w-8 h-8 rounded-full bg-gray-100" alt="Avatar">
                                
                                    </div>
                                    <div class="text-xs ml-4 col-span-10">
                                        <p>{{ commentaire.commentaire }}</p>
                                    </div>
                                    <div class="text-xs col-span-12 flex justify-end items-end">
                                        <span class="mt-1">  {{moment( commentaire.created_at).format('ll') }}</span>
                                    </div>
    
                                    
                                </div>
                            </div>
                            <div class="mt-4">
                                <AjoutCommentaire url="commentaire-courrier/add" @new="setNewComment" :model_id="courrierData.id"/>
                            </div>
                        </div>
                    </div>
                </div>
    
            
            <div class="col-span-4 shadow-md  p-4 grid grid-cols-1">
                <div>
                    <span class="font-semibold text-gray-500">
                        Utilisateurs ({{ courrierData.users.length }})
                    </span>
                    <span @click="showComponent = 3" class="underline font-semibold py-2 text-green-400 bg-green-50 rounded-full px-2 text-xs cursor-pointer hover:bg-green-200">Ajouter des utilisateurs</span>
                    <div v-for="user in courrierData.users" :key="user.id" class="text-sm mt-2">
                        <span >{{ user.name }}</span>
                    </div>
                </div>
                <div>
                    <span class="font-semibold text-gray-500">
                        Notes Techniques ({{ courrier.note_techniques.length }})
                    </span>
                    <div class="py-2">
                        <div @click="getCurrentNote(note)" v-for="note in courrier.note_techniques" :key="note.id" class="text-xs hover:cursor-pointer hover:bg-slate-100 p-1">
                           <span> {{ note.name }}</span>
                           <span class="ml-2"> {{ moment(note.created_at).format('ll') }}</span>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        <NoteTechniqueForm :courrier v-if="showComponent == 4" action="add" :note="newNote"/>
         <DetailsNoteTechnique @closeMe="showComponent = 1" :note="currentNote"  v-if="showComponent == 2 "/>
         <DispatchCourrier @userAdded="addUser" @userRemoved="removeUser" :courrier v-if="showComponent == 3"/>
    </div>
</template>
<script setup>
    import AjoutCommentaire from '@/Components/Courrier/AjoutCommentaire.vue';
    import NoteTechniqueForm from '@/Components/NoteTechnique/NoteTechniqueForm.vue';
    import DetailsNoteTechnique from '@/Components/NoteTechnique/DetailsNoteTechnique.vue';
    import moment from 'moment';
    import DispatchCourrier from '@/Components/Courrier/DispatchCourrier.vue'
    import {ref,onMounted} from 'vue'
    import useAxios from '@/ComponentsServices/axios';
    
import UploadAnnexes from '@/Components/UploadAnnexes.vue'

    const props = defineProps({
        courrier:Object
    })
    const {axios_get} = useAxios()
    
    const emit = defineEmits(['closeMe'])
    const profil = ref('https://ui-avatars.com/api/?name=')
    const courrierData = ref(props.courrier)
    const currentNote = ref({})
    const showComponent = ref(1)
    const annexes_missed = ref()
    const total_annexes = ref()
    const addAnnexes = ref(false)
    const setNewComment = (e)=>{
        courrierData.commentaires.push(e)
    }

    const getCurrentNote = (note)=>{
        currentNote.value = note
        showComponent.value = 2
    }

    const newNote = ref({})
    const addUser = (e)=>{
    }
    const removeUser = (e)=>{
        
        courrierData.value.users =  courrierData.value.users.filter((u)=>u.id != e)
    }

    onMounted(() => {

        axios_get('service/'+props.courrier.service_id+'/get-doc').then(({data})=>{

            total_annexes.value = data.length
            annexes_missed.value = data.filter((obj) => !props.courrier.annexes.some((otherObj) => otherObj.name === obj.name));
            console.log(annexes_missed.value);

        })  
    })


    const close = ()=> emit('closeMe')
    
</script>