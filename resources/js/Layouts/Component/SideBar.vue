<template>
  <div class="w-full  pt-4 z-50 h scroll overflow-auto">
      <aside
    class="h-screen pt-14  w-full transition-transform -translate-x-full bg-white  border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav"
    id="drawer-navigation"
  >
    <div class="overflow-y-auto py-5 px-3">
      <form action="#" method="GET" class="md:hidden mb-2">
        <label for="sidebar-search" class="sr-only">Search</label>
        <div class="relative">
          <div
            class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
          >
            <svg
              class="w-5 h-5 text-gray-500 dark:text-gray-400"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
              ></path>
            </svg>
          </div>
          <input
            type="text"
            name="search"
            id="sidebar-search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Search"
          />
        </div>
      </form>
      <ul class="space-y-2">

        <SideBarItemDropDown  v-for="menu in $page.props.menu.pages[0]" :key="menu.id" :path="menu.path"  :name="menu.name">
          <template #icon>
            <svg
              aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
          </template>
        </SideBarItemDropDown>
      </ul>
    </div>
   
  </aside>
  </div>
</template>
<script setup>

  import SideBarItemDropDown from './SideBarItem.vue';



</script>

<style  scoped>

.h{
    height: calc(100% - 0px);
}
.h1{
    height: 10%;
}
.h9{
    height: 90%;
}
._h{
    height: calc(100vh - 0px);
}
.scroll::-webkit-scrollbar-track
{
    background-color: rgb(248, 250, 252);
}

.scroll::-webkit-scrollbar
{
    width: 5px;
    background-color: #F5F5F5;
}

.scroll::-webkit-scrollbar-thumb
{
    background-color: #c9c8c8;
}
.scroll::-webkit-scrollbar-thumb:hover
{
    background-color: #b3b2b2;
}
</style>
