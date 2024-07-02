<template>
    <div class="grid grid-cols-1 p-4" id="lettre">
        <div class="py-2">
            <span class="font-semibold text-gray-400">Destinataire :</span>
            <p>{{ note.destinataire }}</p>
        </div>
        <div class="py-2">
            <span class="font-semibold text-gray-400">Copie a :</span>
            <p>{{ note.copiea }}</p>
        </div>
       
        <div class="py-2">
            <span class="font-semibold text-gray-400">Objet : </span>
            <p>{{ note.objet }}</p>
        </div>
        
        <div class="py-2">
            <span class="font-semibold text-gray-400">Lettre : </span>
            <p v-html="note.lettre"></p>
        </div>
        <div class="py-2">
            <span class="font-semibold text-gray-400">Signataire : </span>
            <p>{{ note.signataire }}</p>
        </div>
        <div v-if="note.annexes" class="py-2">
            <span class="font-semibold text-gray-400">Annexes</span>
            <div>
                <a v-for="annexe in note.annexes" :href="'../download/'+ annexe.path.replaceAll('/','++')" target="_blank" class="font-bold text-sm text-blue-300 ml-4">{{ annexe.name }}</a> 
            </div>
        </div>
        

    </div>
    <div class="py-2 grid grid-cols-2 gap-2">
        <Fwb-button @click="exportHTML">
            Imprimer
        </Fwb-button>
        <Fwb-button @click="showResponseForm">
            Classer
        </Fwb-button>
    </div>
    <div v-if="showResponse">
        <ReponseLettreForm @hideMe="showResponse = false" :model_id="note.courrier_id"/>
    </div>
</template>
<script setup>
    import {ref} from 'vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import ReponseLettreForm from './ReponseLettreForm.vue'
    import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'

        const {axios_post_simple} = useAxios()
        const props = defineProps({
            note:Object
        })

        const showResponse = ref(false)
        const printLettre = ()=>{

            axios_post_simple('note-technique/imprimmer/'+note.id).then(({data})=>{

                if (data.type ==='success') {

                    exportHTML() 
                }
            }).catch((error)=>{
                console.log(error.response);
            })
        }

        const  exportHTML = ()=>{
            var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
                    "xmlns:w='urn:schemas-microsoft-com:office:word' "+
                    "xmlns='http://www.w3.org/TR/REC-html40'>"+
                    "<head><meta charset='utf-8'><title>Export HTML to Word Document with JavaScript</title></head><body>";
            var footer = "</body></html>";
            var sourceHTML = header+document.getElementById("lettre").innerHTML+footer;
            
            var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
            var fileDownload = document.createElement("a");
            document.body.appendChild(fileDownload);
            fileDownload.href = source;
            fileDownload.download = 'document.doc';
            fileDownload.click();
            document.body.removeChild(fileDownload);
        }

        const showResponseForm = ()=>{
            showResponse.value = true

        }
</script>