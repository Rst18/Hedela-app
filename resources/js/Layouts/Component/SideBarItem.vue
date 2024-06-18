<template>
     <li>
      <NavLink :href="!dropDown && route(path)" :active="!dropDown && route().current(path)" class="flex flex-col w-full p-2 text-sm font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <button
        type="button"
        class="flex items-center w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
        :aria-controls="`dropdown-${name.trim().toLowerCase()}`"
        :data-collapse-toggle="`dropdown-${name.trim().toLowerCase()}`"
        >
        <span class="w-6 h-6">
          <slot name="icon"/>
        </span>
        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{name}}</span>
              <svg v-if="dropDown"
              aria-hidden="true"
              class="w-6 h-6"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
              >
              <path
              fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"
              ></path>
            </svg>
          </button>
          <ul :id="`dropdown-${name.trim().toLowerCase()}`" class="hidden py-2 space-y-2">
            <slot v-if="dropDown"/>
          </ul>
        </NavLink>
        </li>
</template>
<script setup>
  import NavLink from '@/Components/NavLink.vue'
    const props = defineProps({
      name : String,
      dropDown : Boolean,
      path : String
    })
</script>