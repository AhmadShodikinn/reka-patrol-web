<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const { props } = usePage();
const locations = ref(props.locations as Array<{ id: number; location_name: string }>);

const criteria = ref({
  criteria_type: 'Rapi',
  criteria_name: '',
  location_id: '',
});

const criteriaTypes = ['Rapi', 'Resik', 'Rawat', 'Rajin', 'Ringkas'];

const submit = () => {
  console.log(criteria.value);
  router.post('/criterias', criteria.value);
};
</script>

<template>
  <Head title="Tambah Kriteria" />

  <AuthenticatedLayout>
    <div class="p-4 mx-auto max-w-xl md:p-6">
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white mb-6">Tambah Kriteria</h2>

      <form @submit.prevent="submit">
        <!-- Jenis Kriteria -->
        <div class="mb-4">
          <label for="criteria_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Kriteria</label>
          <select
            id="criteria_type"
            required
            v-model="criteria.criteria_type"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          >
            <option value="">-- Pilih Tipe Kriteria --</option>
            <option v-for="type in criteriaTypes" :key="type" :value="type">
              {{ type }}
            </option>
          </select>
        </div>

        <!-- Nama Kriteria -->
        <div class="mb-4">
          <label for="criteria_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kriteria</label>
          <textarea
            id="criteria_name"
            required
            type="text"
            v-model="criteria.criteria_name"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          />
        </div>

        <!-- Lokasi -->
        <div class="mb-6">
          <label for="location_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lokasi</label>
            <select
            id="location_id"
            required
            v-model="criteria.location_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          >
            <option value="">-- Pilih Lokasi --</option>
            <option v-for="position in locations" :key="position.id" :value="position.id">
              {{ position.location_name }}
            </option>
          </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="rounded-md bg-green-600 text-white px-4 py-2 text-sm font-semibold shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-green-500"
          >
            Tambah Kriteria
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
