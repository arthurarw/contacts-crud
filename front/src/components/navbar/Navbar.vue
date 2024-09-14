<script setup lang="ts">

const handleOpen = () => {
  const menu = document.getElementById('menu');
  menu?.classList.toggle('hidden');
}

</script>

<template>
  <header class="bg-slate-200">
    <div class="container flex items-center h-20 px-4 mx-auto">
      <div class="flex flex-row gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        <div class="font-black">
          USER MANAGER
        </div>
      </div>

      <!-- Mobile Menu Button -->
      <div class="ml-auto sm:hidden">
        <button id="menu-btn" class="text-black focus:outline-none" @click.prevent="handleOpen">
          <svg class="size-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>

      <nav id="menu" class="hidden ml-auto sm:flex">
        <ul class="flex items-center space-x-4">
          <li>
            <router-link :to="{ name: 'home' }" class="text-sm text-black hover:text-gray-400 hover:underline">Home</router-link>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- end header -->
</template>
