<script setup lang="ts">
import PaginationComponent from '@/components/Pagination.vue';
import { onMounted, ref } from 'vue';
import { useUsersStore } from '@/stores/users';
import Swal from 'sweetalert2';

const userStore = useUsersStore();
onMounted(async () => {
  await loadUsers();
});

const loading = ref(false);
const perPage = ref(10);

const loadUsers = async (page: number = 1) => {
  loading.value = true;
  await userStore.getPaginate(page, perPage.value).finally(() => {
    loading.value = false;
  });
}

const deleteUser = async (uuid: string) => {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You will not be able to recover this user!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, keep it',
  }).then(async (result) => {
    if (result.isConfirmed) {
      await userStore.destroy(uuid).then(() => {
        Swal.fire('Deleted!', 'User has been deleted.', 'success');
        loadUsers();
      }).catch(() => {
        Swal.fire('Error!', 'User has not been deleted.', 'error');
      });
    }
  });
}

</script>

<template>
  <div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold">Users</h1>

    <div class="flex flex-row justify-end mb-5">
      <router-link :to="{ name: 'users.store' }" class="p-3 text-white bg-blue-700 rounded border-1 flex-no-shrink border-teal hover:text-white hover:bg-blue-800">
        Create a new user</router-link>
    </div>


    <div v-if="loading">Loading...</div>

    <div class="flex flex-row justify-end mb-4">
      <form action="#" method="get" @submit.prevent="loadUsers(1)" class="flex mt-4">
        <label for="totalPerPage" class="px-3 py-2 mr-4 text-gray-700">Total per page:</label>
        <select name="totalPerPage" v-model="perPage" class="px-3 py-2 mr-4 border rounded shadow appearance-none text-grey-darker">
          <option value="4">4</option>
          <option value="10">10</option>
          <option value="15">15</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <button type="submit" class="p-3 text-white bg-blue-700 rounded border-1 flex-no-shrink border-teal hover:text-white hover:bg-blue-800">Filter</button>
      </form>
    </div>

    <div class="flex flex-col">
      <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
          <div class="overflow-hidden border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    ID
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    Name
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    Email
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    Phone
                  </th>
                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    Birthday
                  </th>

                  <th scope="col" class="px-6 py-3 text-xs font-bold text-left text-gray-500 uppercase">
                    Actions
                  </th>

                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="user in userStore.users" :key="user.id">
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ user.uuid }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ user.name }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ user.email }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ user.phone }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ user.birthday }}</td>
                  <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">
                    <router-link :to="{ name: 'users.show', params: { uuid: user.uuid } }" class="text-blue-600 hover:text-blue-900">Show</router-link>
                    <router-link :to="{ name: 'users.edit', params: { uuid: user.uuid } }" class="ml-2 text-yellow-600 hover:text-yellow-900">Edit</router-link>
                    <a href="#" @click.prevent="deleteUser(user.uuid)" class="ml-2 text-red-600 hover:text-red-900">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <pagination-component :data="userStore.meta" @loadPage="loadUsers"></pagination-component>
  </div>
</template>
