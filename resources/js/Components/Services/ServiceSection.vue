<template>
    <div class="container relative flex flex-col justify-between h-full max-w-6xl px-4 mx-auto xl:px-0 mt-5">
    <!-- <h2 class="mb-1 text-7xl font-extrabold leading-tight text-gray-600">Services</h2> -->
    <!-- <p class="mb-12 text-lg text-gray-500">Here is a few of the awesome Services we provide.</p> -->
    <div class="w-full">
        <div class="flex flex-col w-full mb-10 sm:flex-row">
            <ServiceItem2 
                title="Gain de temps, d'efficacité et Réduction des coûts opérationnels"
                content="Optimisez vos processus et réduisez le temps consacré à la gestion manuelle des audiences,
                 Diminuez les dépenses liées aux erreurs de planification et aux manques de communication"
            />
            <ServiceItem
                 title="Planification simplifiée des audiences"
                content="Créez, modifiez et planifiez des audiences en toute simplicité, 
                        en tenant compte des disponibilités des parties prenantes.
                 Organisez des réunions internes et des rencontres avec des clients de manière structurée et efficace"
            />
        </div>
        <div class="flex flex-col w-full mb-5 sm:flex-row">
            <ServiceItem title="Notifications automatiques" content="Recevez des rappels par e-mail et SMS pour les audiences à venir, 
            garantissant ainsi que vous ne manquerez jamais un rendez-vous."/>
            <ServiceItem2 title="Suivi des progrès en temps réel" content="Suivez l'avancement de chaque audience et consultez les notes et les documents associés à tout moment.e"/>
        </div>
    </div>
</div>
</template>
<script setup>
    import ServiceItem from './ServiceItem.vue'
    import ServiceItem2 from './ServiceItem2.vue'
</script>