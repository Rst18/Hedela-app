<script setup>
import { Head, Link } from '@inertiajs/vue3';
import WelcomCardPresentation from '@/Components/WelcomCardPresentation.vue'
import DigitalPresentationSVG from '@/Components/DigitalPresentationSVG.vue'
import Footer from '@/Components/Footer.vue'
import {onMounted,ref} from 'vue'
import AlertNotification from '@/Components/AlertNotification.vue'
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
const showNotification = ref(true)

</script>

<template>
    <Head title="Welcome" />
    <div class="backgroup_image">
        <div class="w-full h-screen grid place-items-center from-[#000000f0] bg-gradient-to-b z-10 to-[#181a1cc7] relative">
            <div class="px-4 lg:w-4/5 h-fit lg:h-[500px]">
                <h1 class="text-2xl lg:text-7xl w-8/12 font-bold text-white"><span class="text-gray-400">Découvrez une gestion des courriers simplifiée avec</span> Hedela-app</h1>
                <p class="text-gray-200  text-2xl my-6 w-8/12"><span class="text-white font-semibold">Hedela-app</span>, Optimise vos processus de traitement de courrier et vous fait gagnez en temps et en productivité. la solution complète de gestion des courriers.</p>
                <a href="/login" class="text-2xl bg-white rounded-full py-2 px-3 hover:ring-4 transition-all duration-500 hover:bg-gray-100 hover:ring-[#ffffff8d] ring-offset-2">Commencez</a>
            </div>
        </div>
    </div>
    <div>
        
    </div>
    <div class="grid grid-col-1 lg:grid-cols-2 lg:py-24  px-4 lg:px-28 gap-9">
        <span class="text-4xl lg:text-6xl font-bold text-gray-900 py-8 lg:col-span-2 lg:text-center ">Fonctionnalités puissantes pour une gestion efficace</span>

        <div class="">   
            <WelcomCardPresentation title="Réception et traitement centralisés">
                Enregistrez et gérez tous vos courriers entrants et sortants en un seul endroit
            </WelcomCardPresentation>  
          
            <WelcomCardPresentation title="Suivi et traçabilité améliorés">
                Suivez le parcours de chaque courrier en temps réel et recevez des notifications à chaque étape.
            </WelcomCardPresentation>  
            <WelcomCardPresentation title="Organisation simplifiée">
                Classez et archivez vos courriers de manière intuitive pour un accès rapide et facile.
            </WelcomCardPresentation>  
            <WelcomCardPresentation title="Collaboration fluide">
                Partagez des courriers et des notes avec vos collègues pour une collaboration efficace.
            </WelcomCardPresentation>  
            <WelcomCardPresentation title=" Automatisation intelligente">
                Automatisez des tâches répétitives comme la création de rapports et la gestion des délais.
                Sécurité renforcée: Protégez vos données sensibles avec des mesures de sécurité robustes.
            </WelcomCardPresentation>  
        </div>
        <div class="">
            <DigitalPresentationSVG/>
           
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 pb-24 px-4 lg:px-28  place-items-center  ">
        <span class="text-4xl lg:text-6xl font-bold text-gray-900 py-8 lg:col-span-2 lg:text-center  ">Gestion des audiences</span>
        
        <div class="">
            <p class="text-4xl px-2 text-black">
                 <span >Optimisez votre organisation et gagnez en efficacité grâce à </span>
           <span class="font-semibold text-yellow-500">Hedela-app</span> , la solution complète de gestion des audiences pour les entreprises et les cabinets.
            </p>
           
        </div>

        <div class="">   
            <WelcomCardPresentation title="Gain de temps, d'efficacité et Réduction des coûts opérationnels">
                Optimisez vos processus et réduisez le temps consacré à la gestion manuelle des audiences,
                Diminuez les dépenses liées aux erreurs de planification et aux manques de communication
            </WelcomCardPresentation>  
            <WelcomCardPresentation title="Planification simplifiée des audiences">
                Créez, modifiez et planifiez des audiences en toute simplicité, 
                en tenant compte des disponibilités des parties prenantes.
                Organisez des réunions internes et des rencontres avec des clients de manière structurée et efficace.
            </WelcomCardPresentation>  
          
            <WelcomCardPresentation title="Notifications automatiques">
                Recevez des rappels par e-mail et SMS pour les audiences à venir,
                 garantissant ainsi que vous ne manquerez jamais un rendez-vous.
            </WelcomCardPresentation>  
            <WelcomCardPresentation title="Suivi des progrès en temps réel">
                 Suivez l'avancement de chaque audience et consultez les notes et les documents associés à tout moment.
            </WelcomCardPresentation>  
              
        </div>
        
    </div>

    <div>
        <Footer/>
    </div>
</template>
