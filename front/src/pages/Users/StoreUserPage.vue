<script setup lang="ts">

import { useUsersStore } from '@/stores/users';
import { useForm } from 'vee-validate';
import { StoreUser } from '@/interfaces/User';
import * as yup from 'yup';
import router from '@/routes';
import { ref } from 'vue';
import { useToast } from "vue-toastification";

const userStore = useUsersStore();
const toast = useToast();
const emit = defineEmits(['showSuccessToast']);

const schema = yup.object({
  name: yup.string().required(),
  email: yup.string().email().required(),
  phone: yup.string().nullable(),
  birthday: yup.date().nullable(),
});

const { values, defineField, errors } = useForm({
  validationSchema: schema,
});

const [name, nameAttrs] = defineField('name');
const [email, emailAttrs] = defineField('email');
const [phone, phoneAttrs] = defineField('phone');
const [birthday, birthdayAttrs] = defineField('birthday');
const formError = ref<string | null>(null);
const loading = ref<boolean>(false);

const submitForm = async () => {
  formError.value = null;
  loading.value = true;
  await userStore.store(values as unknown as StoreUser)
    .then(_response => {
      toast.success('User saved successfully');
      router.push({ name: 'home' });
    })
    .catch((error) => {
      toast.error('Error saving user');
      if (error.status === 422) {
        formError.value = error.response.data.message ?? 'Something went wrong';
      }
    }).finally(() => {
      loading.value = false;
    });
}

</script>

<template>
  <div class="container mx-auto">
    <h1 class="mb-8 text-2xl font-bold">Create User</h1>
    <form @submit.prevent="submitForm">
      <div class="mt-4 mb-4" v-if="formError">
        <span class="mt-2 text-xs font-bold text-red-500">{{ formError }}</span>
      </div>
      <div class="grid grid-cols-2 gap-2">
        <div class="mb-4">
          <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Name</label>
          <input v-model="name" v-bind="nameAttrs" type="text" id="name" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Your name" />
          <span class="mt-2 text-xs font-bold text-red-500">{{ errors.name }}</span>
        </div>
        <div class="mb-4">
          <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
          <input v-model="email" v-bind="emailAttrs" type="email" id="email" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Your email" required />
          <span class="mt-2 text-xs font-bold text-red-500">{{ errors.email }}</span>
        </div>

        <div class="mb-4">
          <label for="phone" class="block mb-2 text-sm font-bold text-gray-700">Phone</label>
          <input v-model="phone" v-bind="phoneAttrs" type="number" id="phone" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Your phone" />
          <span class="mt-2 text-xs font-bold text-red-500">{{ errors.phone }}</span>
        </div>

        <div class="mb-4">
          <label for="birthday" class="block mb-2 text-sm font-bold text-gray-700">Birthday</label>
          <input v-model="birthday" v-bind="birthdayAttrs" type="date" id="birthday" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" placeholder="Your birthday" />
          <span class="mt-2 text-xs font-bold text-red-500">{{ errors.birthday }}</span>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <router-link :to="{ name: 'home' }" class="flex items-center gap-2 px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
          </svg> Back</router-link>
        <button type="submit" :disabled="loading" class="px-4 py-2 font-bold text-white bg-green-700 rounded hover:bg-green-800 focus:outline-none focus:shadow-outline">
          Save
        </button>
      </div>
    </form>
  </div>
</template>
