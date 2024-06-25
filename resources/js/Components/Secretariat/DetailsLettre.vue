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
        

    </div>
    <div class="py-2">
            <Fwb-button @click="exportHTML">
                Imprimer
            </Fwb-button>
        </div>
</template>
<script setup>

    import useAxios from '@/ComponentsServices/axios.js'

    import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'

        const {axios_post_simple} = useAxios()
        const props = defineProps({
            note:Object
        })
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
</script>