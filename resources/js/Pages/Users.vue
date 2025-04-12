<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const users = props.userData as Array<{
  id: number;
  nip: string;
  name: string;
  email: string;
  position: string | null;
}>;
</script>

<template>
  <Head title="Manajemen Pengguna" />

  <AuthenticatedLayout>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
        <!-- Search & Tambah -->
        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
          <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">Manajemen Pengguna</h2>
        <button
          type="button"
          class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
        >
          Tambah Pengguna
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
                <th class="w-32 px-5 py-3 sm:px-6">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">NIP</p>
                </th>
                <th class="w-48 px-5 py-3 sm:px-6">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Nama Pengguna</p>
                </th>
                <th class="w-64 px-5 py-3 sm:px-6">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Alamat E-mail</p>
                </th>
                <th class="w-40 px-5 py-3 sm:px-6">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Role</p>
                </th>
                <th class="w-32 px-5 py-3 sm:px-6">
                    <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Aksi</p>
                </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                <tr v-for="(user, index) in users" :key="user.id">
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ index + 1 }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ user.nip }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ user.name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ user.email }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ user.position ?? '-' }}</td>
                <td class="px-5 py-4 sm:px-6">
                    <div class="flex space-x-2">
                    <button class="text-blue-600 dark:text-blue-400 hover:underline">Edit</button>
                    <button class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                    </div>
                </td>
                </tr>
            </tbody>
            </table>
        </div>
      </div>
      <!-- End Table -->
    </div>
  </AuthenticatedLayout>
</template>
