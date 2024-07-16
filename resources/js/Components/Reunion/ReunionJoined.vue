<template>
  <div class="grid grid-cols-4 gap-2 py-2">
    <a href="../../reunion/list-page">
      <RButton v-if="reunion.status !== 2" class="bg-red-700 text-white"
        >Quitter la reunion</RButton
      ></a
    >
  </div>
  <div class="relative grid grid-cols-12 gap-4">
    <div
      class="col-span-3 grid grid-cols-1 gap-4 p-4 rounded-r-2xl border shadow-md h scroll overflow-auto"
    >
      <OptionsComponent
        @showAidesMemoire="chooseAideMemoire"
        @showDemandeP="showDemandeParole = true"
        :reunion
        :is_Admin
      />
    </div>
    <div class="col-span-7 border rounded-2xl p-8 shadow-md h scroll overflow-auto">
      <AidesMemoireList
        :aides_memoire="reunion.aides_memoire"
        v-if="addAideMemoireAdmin"
        @closeMe="addAideMemoireAdmin = false"
      />

      <DemandeParole
        v-if="showDemandeParole"
        :demandes="reunion.demande_parole"
        @close-me="showDemandeParole = false"
      />
      <div>
        <DetailsRenionComponent :reunion />
      </div>
    </div>
    <div class="col-span-2 border rounded-l-2xl px-4 py-2 h scroll overflow-auto">
      <span class="text-md font-semibold text-gray-700">Utilisateurs Connectes </span>
      <div
        v-for="u in users_connected"
        :key="u.id"
        class="text-xs px-2 py-1 mt-1 hover:cursor-pointer hover:bg-gray-100"
      >
        <span>{{ u.name }}</span>
        <button class="bg-green-300 h-2 w-2 rounded-full ml-1"></button>
      </div>
    </div>
  </div>
  <div v-if="addAideMemoireUser" class="absolute right-0 bottom-10 w-96 z-50 bg-gray-50">
    <AideMemoire @hideMe="chooseAideMemoire" :reunion />
  </div>
  <AlertNotification
    @closeMe="showNotification = false"
    v-if="showNotification && is_Admin === 1"
    :message="notification_message.message"
  />
</template>

<script setup>
import AidesMemoireList from "./AidesMemoireList.vue";
import AideMemoire from "./AideMemoire.vue";
import { ref, onMounted } from "vue";
import useAxios from "@/ComponentsServices/axios";
import DetailsRenionComponent from "./DetailsRenionComponent.vue";
import OptionsComponent from "./OptionsComponent.vue";
import RButton from "./RButton.vue";
import AlertNotification from "@/Components/AlertNotification.vue";
import DemandeParole from "./DemandeParoleComponent.vue";

const props = defineProps({
  reunion: Object,
  is_Admin: Number,
});

const { axios_post_simple } = useAxios();
const emit = defineEmits(["closeMe"]);
const addAideMemoireAdmin = ref(false);
const addAideMemoireUser = ref(false);
const showNotification = ref(false);
const showDemandeParole = ref(false);
const users_connected = ref([]);
const notification_message = ref();

const close = () => {
  emit("closeMe");
};

const chooseAideMemoire = () =>
  props.is_Admin === 1
    ? (addAideMemoireAdmin.value = true)
    : (addAideMemoireUser.value = true);

const demanderParole = () => {};

const presenceEvent = (reunionId) => {
  window.Echo.join(`reunion.${reunionId}`)
    .here((users) => {
      users_connected.value = users;
    })
    .joining((user) => {
      users_connected.value.push(user);
    })
    .leaving((user) => {
      users_connected.value = users_connected.value.filter((u) => u.email != user.email);
    });
};

const aideMemoire = (reunion_id) => {
  window.Echo.channel(`reunion-${reunion_id}`).listen("AideMemoireSent", (e) => {
    notification_message.value = e.message;
    showNotification.value = true;
    // Ajoutez le message au DOM
  });

  //   window.Echo.channel(`reunion-${reunion_id}`).listen("DemandeParoleSent", (e) => {
  //     console.log(e);
  //     // Ajoutez le message au DOM
  //   });
};
const demandeParoleReponse = () => {
  console.log("object");
  window.Echo.private("App.Models.User.1").notification((notification) => {
    console.log("notification");
  });
};

onMounted(() => {
  presenceEvent(props.reunion.id.replaceAll("/", "-"));
  aideMemoire(props.reunion.id.replaceAll("/", "-"));
  demandeParoleReponse();
});
</script>

<style scoped>
.h {
  height: calc(100vh - 220px);
}
.h1 {
  height: 10%;
}
.h9 {
  height: 90%;
}
._h {
  height: calc(100vh - 0px);
}
.scroll::-webkit-scrollbar-track {
  background-color: rgb(248, 250, 252);
}

.scroll::-webkit-scrollbar {
  width: 5px;
  background-color: #f5f5f5;
}

.scroll::-webkit-scrollbar-thumb {
  background-color: #c9c8c8;
}
.scroll::-webkit-scrollbar-thumb:hover {
  background-color: #b3b2b2;
}
</style>
