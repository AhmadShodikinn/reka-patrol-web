<script setup lang="ts">
import { Head, usePage, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const { props } = usePage();
const positions = ref(props.positions as Array<{ id: number; position_name: string }>);

const user = ref({
  nip: '',
  name: '',
  email: '',
  position_id: null,
});

const submit = () => {
  router.post('/users', user.value);
};
</script>

<template>
  <Head title="Tambah Pengguna" />

  <AuthenticatedLayout>
    <div class="p-4 mx-auto max-w-xl md:p-6">
      <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white mb-6">Tambah Pengguna</h2>

      <form @submit.prevent="submit">
        <!-- NIP -->
        <div class="mb-4">
          <label for="nip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIP</label>
          <input
            id="nip"
            type="text"
            v-model="user.nip"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          />
        </div>

        <!-- Nama -->
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
          <input
            id="name"
            type="text"
            v-model="user.name"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          />
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
          <input
            id="email"
            type="email"
            v-model="user.email"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          />
        </div>

        <!-- Jabatan -->
        <div class="mb-6">
          <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Posisi</label>
          <select
            id="position"
            v-model="user.position_id"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
          >
            <option value="">-- Pilih Posisi --</option>
            <option v-for="position in positions" :key="position.id" :value="position.id">
              {{ position.position_name }}
            </option>
          </select>
        </div>

        <!-- Tombol Simpan -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="rounded-md bg-green-600 text-white px-4 py-2 text-sm font-semibold shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-green-500"
          >
            Tambah Pengguna
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>
