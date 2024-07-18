<template>
    <div class="mb-4">
        <div class="grid grid-cols-2 gap-4">

            <div class="col-span-2">
                <fwb-textarea
                    v-model="form.description"
                    placeholder="Description"
                    :rows="2"
                    label="Description"
                />
                <div class="text-red-500 text-xs py-2" v-if="errors.description">
                    {{ errors.description[0]}}
                </div>
            </div>



            <div class="mt-4  col-span-2 flex justify-between">

                <Fwb-button @click="add" class="bg-gray-800 hover:bg-slate-700">
                    Ajouter
                </Fwb-button>

                <Fwb-button @click="sendData" class="bg-gray-800 hover:bg-slate-700">
                    Terminer et passer
                </Fwb-button>

            </div>
        </div>

        <div class="text-xs">
            <div class="mt-3 w-full p-3 font-semibold bg-gray-100 grid grid-cols-12 gap-1">
                <div class="col-span-1">#</div>
                <div class="col-span-10">Description</div>
                <div class="col-span-1">Options</div>
            </div>
            <div v-for="b of sondage_items" :key="b.id" class="w-full p-3 grid grid-cols-12 gap-1 hover:bg-slate-200 hover:cursor-pointer">
                <div class="col-span-1">#</div>
                <div class="col-span-10">{{b.description }}</div>
                <div @click="removeItem(b)" class="col-span-1 border rounded-full w-fit px-1">X</div>

            </div>
        </div>

    </div>
</template>
<script setup>
import {ref,onMounted} from 'vue'
import useAxios from '@/ComponentsServices/axios.js'
import { FwbA, FwbButton, FwbFileInput,FwbTextarea,FwbInput } from 'flowbite-vue'
import Swal from 'sweetalert2';

        const props = defineProps({
            sondage:Object,
            sondage_item:Object,
        })

        const emit = defineEmits(['added','updated'])
        const sondage_items = ref(props.sondage_item ? props.sondage_item :[])
        const {axios_post_simple} = useAxios();
        const form = ref({
            description:''
        })
        const errors = ref([])

        const add = ()=>{
            if (form.value.name != '') {

                sondage_items.value.push(
                    {
                        id:sondage_items.value.length + 1,
                        description:form.value.description,
                    }
                )
            }else alert('Veillez remplir les champs vides')
        }
        const removeItem = (obj)=>{
            sondage_items.value = sondage_items.value.filter((o)=> o != obj)
        }

        const sendData = ()=>{
            emit('added', sondage_items.value)
        }



</script>
