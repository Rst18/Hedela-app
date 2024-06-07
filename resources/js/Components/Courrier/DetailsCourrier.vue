<template>
    <div class="grid grid-cols-12 px-6 gap-2">
        
            <div class="col-span-8 shadow-md">
                <div class="  grid grid-cols-2 gap-2 p-4">

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

        
        <div class="col-span-4 shadow-md p-4">

        </div>
    </div>
    <NoteTechniqueForm :courrier/>
</template>
<script setup>
    import AjoutCommentaire from '@/Components/Courrier/AjoutCommentaire.vue';
    import NoteTechniqueForm from '@/Components/NoteTechnique/NoteTechniqueForm.vue';
import moment from 'moment';
    import {ref,onMounted} from 'vue'

    const props = defineProps({
        courrier:Object
    })
    
    const profil = ref('https://ui-avatars.com/api/?name=')
    const courrierData = ref(props.courrier)

    const setNewComment = (e)=>{
        courrierData.commentaires.push(e)
    }
</script>