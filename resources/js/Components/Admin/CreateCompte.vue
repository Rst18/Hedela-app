<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Registerillustration from '@/Components/Registerillustration.vue';
import useAxios from '@/ComponentsServices/axios.js'
import {ref,onMounted } from 'vue'
import SelectComponent from '@/Components/SelectComponent.vue'
const form = useForm({
    name: '',
    email: '',
    password: '12345678',
    password_confirmation: '12345678',
    role:''
});
const {axios_get} = useAxios()
const roles = ref()
const getSeletedOption = (e) => form.role = e
const submit = () => {
    form.post(route('profile.create'), {
        onFinish: () => form.reset('password', 'password_confirmation','email','name'),
    });
};
onMounted(() => {
    axios_get('../role/list-simple').then(({data})=>{
        roles.value = data
    })
})
</script>

<template>
        <div class="grid grid-cols-1 lg:grid-cols-8 p-6">
            
            <div class="col-span-4 grid grid-cols-1 py-6 ">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />
        
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
        
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
        
                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
        
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />
        
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mt-4">
                        <SelectComponent @selectedOption="getSeletedOption" :options="roles">
                            Choisir le groupe
                        </SelectComponent>
                        <InputError class="mt-2" :message="form.errors.role" />
                    </div>
        
                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />
        
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
        
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    
        
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
        
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
        
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
        
                    <div class="flex items-center justify-end mt-4">
                      
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Inscription
                        </PrimaryButton>
                    </div>
                </form>
            </div>
            <div class="col-span-4">
               <Registerillustration/>
            </div>
        </div>
</template>
