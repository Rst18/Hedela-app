<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import LoginIllustration from '@/Components/LoginIllustration.vue';
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-8">
            <div class="col-span-4">
               <LoginIllustration/>
            </div>
            <div class="col-span-4 grid grid-cols-1 py-6 ">
                <!-- <span >Connexion</span> -->
                <form @submit.prevent="submit" class="shadow py-24 px-10 border rounded-md">
                    <div>
                        <InputLabel for="email" value="Email"  class="font-extrabold text-slate-950"/>
    
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />
    
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
    
                    <div class="mt-4">
                        <InputLabel for="password" value="Mot de passe" class="font-extrabold text-slate-950" />
    
                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />
    
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
    
                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm font-extrabold text-gray-800">Se souvenir de moi</span>
                        </label>
                    </div>
    
                    <div class="flex items-center justify-end mt-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm font-extrabold text-gray-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Mot de passe oublier ?
                        </Link>
    
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Connexion
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>

    </GuestLayout>
</template>
