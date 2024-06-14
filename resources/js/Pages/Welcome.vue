<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="backgroup_image">
        <div class="w-full h-screen grid place-items-center from-[#000000f0] bg-gradient-to-b z-10 to-[#181a1cc7] ">
            <div class="w-8/12 h-[500px]">
                <h1 class="text-7xl w-8/12 font-bold text-white"><span class="text-gray-400">Découvrez une gestion des courriers simplifiée avec</span> Hedela-app</h1>
                <p class="text-gray-200  text-2xl my-6 w-8/12"><span class="text-white font-semibold">Hedela-app</span>, Optimise vos processus de traitement de courrier et vous fait gagnez en temps et en productivité. la solution complète de gestion des courriers.</p>
                <a href="/login" class="text-2xl bg-white rounded-full py-2 px-3 hover:ring-4 transition-all duration-500 hover:bg-gray-100 hover:ring-[#ffffff8d] ring-offset-2">Commencez</a>
            </div>
        </div>
    </div>
</template>
