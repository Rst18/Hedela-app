<template>
    <div >
        <div class="grid grid-cols-3 gap-4 p-4">
            <div>
                <fwb-input
                    v-model="name"
                    placeholder="Rostand M"
                    label="Noms"
                />
                <div class="text-red-500" v-if="errors.name">
                    {{ errors.name[0]}}
                </div>
            </div>
            <div>
                <fwb-input
                    v-model="email"
                    placeholder="exemple@gmail.com"
                    label="Email"
                />
                <div class="text-red-500" v-if="errors.emil">
                    {{ errors.email[0]}}
                </div>
            </div>
            <div>
                <fwb-input
                    v-model="phone"
                    placeholder="243975476177"
                    label="Telephone"
                />
                <div class="text-red-500" v-if="errors.phone">
                    {{ errors.phone[0]}}
                </div>
            </div>
            <div>
                <Fwb-button class="bg-gray-800" @click="add">
                    Ajouter
                </Fwb-button>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { FwbInput,FwbButton,FwbRadio,FwbP,FwbTextarea } from 'flowbite-vue'
    import {ref} from 'vue'
        const emit = defineEmits(['add'])

        // const form = ref({
        //     name:'',
        //     email:'',
        //     phone:''
        // });

        const name = ref('')
        const phone = ref('')
        const email = ref('')
        
        const errors = ref([])
    const add = ()=>{
        if (name.value && phone.value && email.value) {
            
            emit('add',{
                name:name.value,
                phone:phone.value,
                email:phone.value
            })
            name.value = ''
            email.value = ''
            phone.value = ''
        }
    }
</script>