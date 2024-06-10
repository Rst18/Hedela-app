<template>
    <div class="relative">

        <div class="grid grid-cols-12 px-6 gap-2" v-show="!showNoteTechnique">
            
                <div class="col-span-8 shadow-md">
                    <div class="grid grid-cols-2 gap-2 p-4">
    
                        <div>
                            <span>Numero :</span>
                            <span> {{ courrierData.number }}</span>
                        </div>
                        <div>
                            <span>Expeditaire :</span>
                            <span> {{ courrierData.sender }}</span>
                        </div>
                        <div>
                            <span>Email :</span>
                            <span> {{ courrierData.email }}</span>
                        </div>
                        <div>
                            <span>Phone :</span>
                            <span> {{ courrierData.phone }}</span>
                        </div>
                        <div>
                            <span>Type Courrier :</span>
                            <span> {{ courrierData.type_courrier_name }}</span>
                        </div>
                        <div>
                            <span>Objet :</span>
                            <span> {{ courrierData.objet }}</span>
                        </div>
                        <div>
                            <span>Numero de la lettre :</span>
                            <span> {{ courrierData.letter_number }}</span>
                        </div>
                        <div>
                            <div class="grid grid-cols-1">
                                <span>Lettre </span>
                                <a :href="'download/'+ courrierData.letter_file.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-300">Imprimer la lettre</a>
                            </div>
                            <div class="grid grid-cols-1">
                                <span>Annexes ({{ courrierData.annexes.length }})</span>
                                <a v-for="annexe in courrierData.annexes" :href="'download/'+ annexe.path.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-700"> {{ annexe.name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 border-t">
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
    
            
            <div class="col-span-4 shadow-md p-4 grid grid-cols-1">
                <div>
                    <span class="font-semibold text-gray-500">
                        Utilisateurs ({{ courrier.users.length }})
                    </span>
                    <div>
    
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
        <!-- <NoteTechniqueForm :courrier/> -->
         <DetailsNoteTechnique :note="currentNote" v-if="showNoteTechnique"/>
    </div>
</template>
<script setup>
    import AjoutCommentaire from '@/Components/Courrier/AjoutCommentaire.vue';
    import NoteTechniqueForm from '@/Components/NoteTechnique/NoteTechniqueForm.vue';
    import DetailsNoteTechnique from '@/Components/NoteTechnique/DetailsNoteTechnique.vue';
    import moment from 'moment';
    import {ref,onMounted} from 'vue'

    const props = defineProps({
        courrier:Object
    })
    
    const profil = ref('https://ui-avatars.com/api/?name=')
    const courrierData = ref(props.courrier)
    const currentNote = ref({})
    const showNoteTechnique = ref(false)
    const setNewComment = (e)=>{
        courrierData.commentaires.push(e)
    }
    const getCurrentNote = (note)=>{
        currentNote.value = note
        showNoteTechnique.value = true
    }
    
</script>