<script setup lang="ts">
import { Head, usePage, router, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SearchBar from '@/Components/Layout/header/SearchBar.vue';

const addCriteria = () => {
  router.get('/criterias/create');
}

const deleteCriteria = async (id: number) => {
  if (confirm('Apakah Anda yakin ingin menghapus kriteria ini?')) {
    await window.axios.delete(route('criterias.destroy', id));
    router.visit('/criterias');
  }
}

const { props, url } = usePage();
const searchParams = new URLSearchParams(url.split('?')[1]);
const searchQuery = searchParams.get('search') || '';

const criteriaRes = props.criteriaRes as {
  data: Array<{
    id: number;
    criteria_type: string;
    criteria_name: string;
    location_id: number;
    location: {
      id: number;
      location_name: string;
    } | null;
  }>;
  meta: {
    from: number;
    to: number;
    total: number;
    per_page: number;
    current_page: number;
    links: Array<{
      url: string | null;
      label: string;
      active: boolean;
    }>;
  };
  links: {
    first: string | null;
    last: string | null;
    prev: string | null;
    next: string | null;
  };
};

</script>

<template>
  <Head title="Manajemen Kriteria 5R" />

  <AuthenticatedLayout>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
      <!-- Search & Tambah -->
      <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">Manajemen Kriteria 5R</h2>
        <SearchBar action="/criterias" :method="'GET'" :placeholder="'Cari Kriteria'" :input-value="searchQuery"
          :on-submit="(e: Event, value: string) => router.visit(`/criterias${e.target ? `?search=${value}` : ''}`)" />
        <button type="button"
          class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
          @click="addCriteria()">
          Tambah Kriteria
        </button>


      </div>

      <!-- Table -->
      <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="max-w-full overflow-x-auto">
          <table class="min-w-full table-fixed text-left">
            <thead>
              <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="w-12 px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">No</p>
                </th>
                <th class="w-128 px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Nama Kriteria</p>
                </th>
                <th class="w-48 px-5 py-3 sm:px-6 text-center">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Tipe</p>
                </th>
                <th class="w-64 px-5 py-3 sm:px-6 text-center">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Lokasi</p>
                </th>
                <th class="w-32 px-5 py-3 sm:px-6 text-center">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Aksi</p>
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
              <tr v-for="(criteria, index) in criteriaRes.data" :key="criteria.id">
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ criteriaRes.meta.from + index }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ criteria.criteria_name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400 text-center">{{ criteria.criteria_type }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400 text-center">{{ criteria.location?.location_name }}</td>
                <td class="px-5 py-4 sm:px-6">
                  <div class="flex space-x-2 justify-center">
                    <Link class="text-blue-600 dark:text-blue-400 hover:underline" :href="route('criterias.edit', criteria.id)">
                    Edit
                    </Link>
                    <button class="text-red-600 dark:text-red-400 hover:underline"
                      @click="deleteCriteria(criteria.id)">Hapus</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800 sm:px-6">
          <div class="flex flex-1 justify-between sm:hidden">
            <button :disabled="!criteriaRes.links.prev" @click="router.visit(criteriaRes.links.prev ?? '#')" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
              Previous
            </button>
            <button :disabled="!criteriaRes.links.next" @click="router.visit(criteriaRes.links.next ?? '#')" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
              Next
            </button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:justify-between items-center">
            <div>
              <p class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan
                <span class="font-medium">{{ criteriaRes.meta.from ?? 1 }}</span>
                sampai
                <span class="font-medium">{{ criteriaRes.meta.to ?? 1 }}</span>
                dari
                <span class="font-medium">{{ criteriaRes.meta.total ?? 1 }}</span>
                hasil
              </p>
            </div>
            <div>
              <ul v-if="criteriaRes.meta.links.length > 3" class="inline-flex -space-x-px rounded-md">
                <li v-for="(link, index) in criteriaRes.meta.links" :key="index">
                  <button v-if="link.url" @click="router.visit(link.url)" :class="{ 'bg-blue-500 text-white': link.active, 'text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700 dark:text-gray-400': !link.active }"
                      class="block px-3 py-2 text-sm font-medium" v-html="link.label"></button>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
      <!-- End Table -->
    </div>
  </AuthenticatedLayout>
</template>
