<template>
    
    <div class="p-8 grid grid-cols-1 shadow-md rounded-md">
        <div>
           <SelectComponent v-model="form.batiment_id" @selectedOption="getSeletedOption" :options="batiments">
            Choisir Batiment
           </SelectComponent>
            <div class="text-red-500 text-xs pb-2" v-if="errors.batiment_id">
                {{ errors.batiment_id[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.number"
                placeholder="280"
                label="Entrer le numero du bureau"
            />
            <div class="text-red-500 text-xs pb-2" v-if="errors.number">
                {{ errors.number[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.name"
                placeholder="Anti chambre"
                label="Entrer le nom du bureau"
            />
            <div class="text-red-500 text-xs pb-2" v-if="errors.name">
                {{ errors.name[0]}}
            </div>
        </div>
        <div>
            <fwb-input
                v-model="form.niveau"
                placeholder="6"
                label="Numero de niveau"
                type="number"
            />
            <div class="text-red-500 text-xs pb-2" v-if="errors.niveau">
                {{ errors.niveau[0]}}
            </div>
        </div>
       
        <div class="py-2">
            <Fwb-button class="bg-gray-800 hover:bg-gray-600" @click="submitForm">
                Enregistrer
            </Fwb-button>
        </div>
        
    </div>
</template>
<script setup >

    import SelectComponent from '@/Components/SelectComponent.vue'
    import { FwbInput,FwbButton,FwbRadio,FwbP } from 'flowbite-vue'
    import useAxios from '@/ComponentsServices/axios.js'
    import {ref} from 'vue'
    import ToggleInput from '@/Components/ToggleInput.vue'

    const props = defineProps({
        bureau:Object,
        action:String,
        batiments:Object,
    })
    const emit = defineEmits(['newAdded'])
    const { axios_post_simple } = useAxios();
    const getSeletedOption = (e) => {
        form.value.batiment_id = e
    }

    const form = ref({
        name:props.bureau.name,
        niveau:props.bureau.niveau,
        number:props.bureau.number,
        batiment_id:props.bureau.batiment_id,
    })
    const errors = ref([]); 

    const submitForm = ()=>{

        if (props.action === 'add') {
            errors.value = []
            axios_post_simple('../bureau/add',form.value).then(({data})=>{

                if (data.type === 'success') {

                    emit('newAdded',data.new)
                    
                }
            }).catch((error)=>{
                if (error.response.status === 422) {
                    errors.value = error.response.data.errors
                }
                console.log(error.response)
            })

        }else if(props.action === 'update'){

            axios_post_simple('../bureau/'+props.bureau.id+'/update',form.value).then(({data})=>{

                if (data.type === 'success') {

                    emit('newAdded')
                    
                }

            }).catch((error)=>{

                if (error.response.status === 422) {

                    errors.value = error.response.data.errors
                }
            })
        }
    }

   
    
</script>