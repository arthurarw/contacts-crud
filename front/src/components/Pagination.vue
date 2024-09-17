<script lang="ts">
import { defineComponent } from 'vue';
import { Pagination } from '@/interfaces/Pagination';

export default defineComponent({
  props: {
    data: {
      type: Object as () => Pagination,
      required: false,
      default: undefined
    }
  },
  setup(_, { emit }) {
    const loadPage = (page: number) => {
      emit('loadPage', page);
    }

    return { loadPage }
  }
})
</script>

<template>
  <div v-if="data && data.total > 0" class="max-w-2xl mt-4">
    <nav class="w-full">
      <ul class="inline-flex -space-x-px">
        <li v-if="data.current_page !== 1">
          <a class="flex items-center justify-center h-8 px-3 leading-tight text-white bg-blue-700 border-teal ms-0 border-e-0 rounded-s-lg hover:bg-blue-800" href="#" @click.prevent="loadPage(data.current_page - 1)">Anterior</a>
        </li>
        <li v-if="data.last_page > 1 && data.current_page !== data.last_page">
          <a class="flex items-center justify-center h-8 px-3 leading-tight text-white bg-blue-700 border-teal hover:bg-blue-800 rounded-e-lg" href="#" @click.prevent="loadPage(data.current_page + 1)">Próxima</a>
        </li>
      </ul>
    </nav>
    <div class="w-full p-3 d-flex justify-content-between">
      <p>Total per page: {{ data.per_page }}</p>
      <p>Total: {{ data.total }}</p>
      <p>Page: {{ data.current_page }} - Last Page {{ data.last_page }}</p>
    </div>
  </div>
</template>
