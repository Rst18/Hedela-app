<template>
  <div
    class="max-w-sm border grid grid-cols-1 gap-2 px-6 rounded-xl h-fit lg:h-28 py-1 mb-2"
  >
    <div
      class="py-2 flex justify-center items-center font-bold text-sm lg:text-xl text-gray-600"
    >
      {{ demande.name }}
    </div>
    <div
      class="grid grid-cols-1 lg:grid-cols-2 gap-2 justify-center items-center text-xs lg:text-sm"
    >
      <RButton @click="refuse" class="bg-red-600 text-white">Refuser</RButton>
      <RButton @click="accept" class="bg-green-600 text-white">Accepter</RButton>
    </div>
  </div>
</template>
<script setup>
import useAxsios from "@/ComponentsServices/axios.js";
import RButton from "./RButton.vue";
const props = defineProps({
  demande: Object,
});
const { axios_post_simple } = useAxsios();

const accept = () => {
  axios_post_simple("../../reunion/accept-demande", {
    reunion: props.demande.pivot.reunion_id,
    user: props.demande.pivot.user_id,
  }).then(({ data }) => {
    console.log(data);
  });
};
const refuse = () => {
  axios_post_simple("../../reunion/refuse-demande", {
    reunion: props.demande.pivot.reunion_id,
    user: props.demande.pivot.user_id,
  }).then(({ data }) => {
    console.log(data);
  });
};
</script>
