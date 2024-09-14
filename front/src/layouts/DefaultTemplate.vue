<script lang="ts">
import Navbar from '../components/navbar/Navbar.vue';


export default {
  name: 'DefaultTemplate',
  components: {
    Navbar,
  }
}
</script>

<template>
  <Navbar />

  <body class="flex items-center justify-center w-full font-sans h-max bg-teal-lightest">
    <div class="w-full p-6 m-4 rounded">
      <router-view></router-view>
    </div>
  </body>
</template>
