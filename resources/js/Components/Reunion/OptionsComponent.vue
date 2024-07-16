<template>
  <div>
    <div>
      <span class="py-2 text-gray-700 font-semibold"
        >Liste des orateurs ({{ reunion.orateurs.length }})</span
      >

      <div class="grid grid-cols-1 gap-2 text-xs py-2">
        <span v-for="o in reunion.orateurs" class="col-span-1 ml-2">
          {{ o.name }}
        </span>
      </div>
    </div>
    <div>
      <span class="py-2 text-gray-700 font-semibold"
        >Liste des intervenants ({{ reunion.demande_parole.length }})</span
      >

      <div class="grid grid-cols-1 gap-2 text-xs py-2">
        <span v-for="o in reunion.demande_parole" class="col-span-1 ml-2">
          {{ o.name }}
        </span>
      </div>
    </div>
    <div class="border-t grid grid-cols-1">
      <span class="text-gray-700 font-semibold">Interractions</span>

      <div v-if="is_Admin === 1" class="grid grid-cols-1 gap-2 text-sm py-4">
        <RButton @click="showDemandeParole">
          Demande  s Parole ({{ nbrDemandeParole }})
        </RButton>
        <RButton>Lever la main </RButton>
        <RButton @click="aideMemoire"> Aides memoire ({{ nbrAideMemoire }}) </RButton>
        <RButton @click="sondage">Creer un sondage </RButton>
        <RButton >Sondages({{ nbrSondage }}) </RButton>
      </div>
      <div v-else class="grid grid-cols-1 gap-2 text-sm py-4">
        <RButton @click="send_demande_parole"> Demande Parole </RButton>
        <RButton @click=""> Lever la main</RButton>
        <RButton @click="aideMemoire"> Envoyer Aide memoire </RButton>
        <RButton @click="showSondage">Sondages ({{ nbrSondage  }}) </RButton>
      </div>
    </div>
  </div>
</template>
<script setup>
    import { ref, onMounted } from "vue";
    import RButton from "./RButton.vue";
    import useAxios from "@/ComponentsServices/axios.js";
        const props = defineProps({
        reunion: Object,
        is_Admin: Number,
        });

        const emit = defineEmits(["showAidesMemoire", "showDemandeP","createSondage","showSondageList"]);
        const { axios_post_simple } = useAxios();
        const nbrAideMemoire = ref(props.reunion.aides_memoire.length);
        const nbrDemandeParole = ref(props.reunion.demande_parole.length);
        const nbrSondage = ref(props.reunion.sondages.length);
        const aideMemoire = () => emit("showAidesMemoire");
        const showDemandeParole = () => emit("showDemandeP");

        const send_demande_parole = () => {
            axios_post_simple("../../reunion/demande-parole/send", {
                reunion_id: props.reunion.id,
            }).then(({ data }) => {
                console.log(data);
            });
        };

        const sondage = ()=>emit('createSondage')
        const showSondage = ()=>emit('showSondageList')




        const aideMemoireSocket = (reunion_id) => {
        window.Echo.channel(`reunion-${reunion_id}`).listen("AideMemoireSent", (e) => {
            console.log(e);
            nbrAideMemoire.value += 1;
            // Ajoutez le message au DOM
        });
        };

        const demandeParoleSocket = (reunion_id) => {
        window.Echo.channel(`reunion-${reunion_id}`).listen("DemandeParoleSent", (e) => {
            //console.log(e);
            nbrDemandeParole.value += 1;
            // Ajoutez le message au DOM
        });
        };
        onMounted(() => {
        aideMemoireSocket(props.reunion.id.replaceAll("/", "-"));
        demandeParoleSocket(props.reunion.id.replaceAll("/", "-"));
        });
</script>
