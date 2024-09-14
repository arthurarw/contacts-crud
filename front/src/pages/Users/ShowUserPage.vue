<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useUsersStore } from '@/stores/users';
import { useRoute } from 'vue-router';
import { computed } from 'vue';
import { User } from '@/interfaces/User';
import router from '@/routes';

const route = useRoute();
const userUuid = computed(() => route.params.uuid.toString());
const userStore = useUsersStore();
const user = ref<User | null>(null);
const loading = ref(false);

onMounted(async () => {
  loading.value = true;

  await userStore.getUser(userUuid.value)
    .then(response => user.value = response)
    .catch(() => router.push({ name: 'home' }))
    .finally(() => {
      loading.value = false;
    });
});

</script>

<template>
  <div class="container mx-auto">
    <div v-if="!user">
      <div v-if="loading">Carregando...</div>
      <div v-else>
        <p>Usuário não encontrado</p>
      </div>
    </div>
    <div v-else class="flex flex-col gap-2">
      <h1 class="text-2xl font-bold">Name: {{ user.name }}</h1>
      <p>UUID: {{ user.uuid }}</p>
      <p>Email: {{ user.email }}</p>
      <p>Created At: {{ user.created_at }}</p>
      <p>Updated At: {{ user.updated_at }}</p>
    </div>
    <div class="flex flex-row mt-4">
      <router-link :to="{ name: 'home' }" class="flex items-center gap-2 px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
        </svg> Back</router-link>
    </div>
  </div>
</template>
