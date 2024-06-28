<template>
    <div class="p-4 mt-4 shadow">
        <div class="grid grid-cols-12 py-2 px-6">
            <button @click="close" class="border w-fit  col-span-2 px-2 bg-slate-100 text-xs text-slate-800 rounded-full ">Retour</button>
            <button v-if="currentNote.status == 1" @click="validerNote"  class="border w-fit p-1 px-2 col-span-4 bg-green-400 text-xs text-slate-50 font-semibold rounded-full flex ">Valider la note Technique <Check class="h-4 w-4 ml-1 text-green-700"/> </button>
            <button v-if="currentNote.status == 2" @click="annuletValiderNote"  class="border w-fit p-1 px-2 col-span-4 bg-red-500 text-xs text-slate-50 font-semibold rounded-full flex ">Annuler la validation <Check class="h-4 w-4 ml-1 text-green-700"/> </button>
        </div>
        <div v-show="!modif">
            <div class="grid grid-cols-2 gap-4">
                <div class="grid grid-cols-1">
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Faits:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.faits }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Analyse:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.analyse }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Conclusion :
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.conclusion }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Actions:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.actions }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Objet:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.objet }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Destinataire:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.destinataire }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        signataire:
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.signataire }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Copie à :
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.copiea }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Type Lettre :
                    </span>
                    <p class="text-sm px-4 py-2">
                        {{ currentNote.type_lettre }}
                    </p>
                </div>
                <div>
                    <span class="font-bold bg-gray-100 text-gray-800 px-2">
                        Annexes :
                    </span>
                    <span> {{ currentNote.annexe }}</span>
                   
                    <div>
                        <a v-for="annexe in currentNote.annexes" :href="'../download/'+ annexe.path.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-300 ml-4">{{ annexe.name }}</a> 
                    </div>
                </div>
            </div>
            <div class="">
                <span class="font-bold bg-gray-100 text-gray-800 px-2">
                    Lettre :
                </span>
                <div v-html="currentNote.lettre" class="p-4">
                
                </div>
            </div>
            <div class="p-4 border-t">
                <span class="text-lg font-bold py-2" >Discussions ( {{ currentNote.commentaires ? currentNote.commentaires.length : 0  }} )</span>
                <div class="mt-4">
                    <div class="px-4">
                        <div v-for="commentaire in currentNote.commentaires" class="shadow-sm p-4 m-2 grid grid-cols-12">
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
                        <AjoutCommentaire url="commentaire-note-technique/add" @new="setNewComment" :model_id="note.id"/>
                    </div>
                </div>
            </div>

        </div>
        <div v-if="modif">
            <NoteTechniqueForm action="update" :note/>
        </div>

    </div>
   
</template>
<script setup>
    import {ref,onMounted} from 'vue'
    import AjoutCommentaire from '@/Components/Courrier/AjoutCommentaire.vue';
    import moment from 'moment'
    import Check from '@/Components/Check.vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import NoteTechniqueForm from '@/Components/NoteTechnique/NoteTechniqueForm.vue'

        const profil = ref('https://ui-avatars.com/api/?name=')
        const props = defineProps({
            note:Object
        })
        const modif = ref(false)
        const emit = defineEmits(['closeMe'])

        const { axios_post_simple } = useAxios()

        const currentNote = ref({})

        const setNewComment = (e)=>{
            currentNote.value.commentaires.push(e)
        }
        const close = ()=>emit('closeMe')

        const validerNote = ()=>{
            axios_post_simple('../note-technique/valider/'+props.note.id).then(({data})=>{
                if (data.type ==='success') {
                    emit('closeMe')
                }
            })
        }
        const annuletValiderNote = ()=>{
            axios_post_simple('../note-technique/inValider/'+props.note.id).then(({data})=>{
                if (data.type ==='success') {
                    emit('closeMe')
                }
            })
        }


        onMounted(() => {
            currentNote.value = props.note
        });


   
</script>