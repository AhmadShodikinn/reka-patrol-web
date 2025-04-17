<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const file = ref<File | null>(null);

// Mock data dokumen
const documents = ref([
  { id: 1, filename: 'SJA CUTTING.pdf', uploaded_at: '2025-04-01 09:30' },
  { id: 2, filename: 'SJA WIRRING.docx', uploaded_at: '2025-04-10 14:22' },
]);

const handleFileUpload = (e: Event) => {
  const target = e.target as HTMLInputElement;
  if (target.files && target.files.length > 0) {
    file.value = target.files[0];
  }
};

const submitFile = () => {
  if (!file.value) return alert('Silakan pilih file terlebih dahulu.');

  const newId = documents.value.length + 1;
  const newDoc = {
    id: newId,
    filename: file.value.name,
    uploaded_at: new Date().toLocaleString(),
  };

  documents.value.push(newDoc);
  file.value = null;
};
</script>

<template>
  <Head title="Upload Dokumen" />

  <AuthenticatedLayout>
    <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
      <!-- Header -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
          Upload Dokumen
        </h2>
      </div>

    <!-- Upload Form -->
    <div
    class="mb-8 w-full bg-white dark:bg-gray-800 rounded-xl shadow border border-dashed border-gray-300 dark:border-gray-600 px-6 py-12 flex flex-col items-center justify-center text-center transition hover:border-blue-400 cursor-pointer"

    >
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-16 w-16 text-gray-400 mb-4">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
    </svg>

    <p class="text-gray-500 text-sm mb-2">Klik untuk memilih dokumen yang ingin diupload</p>
    <input
        ref="fileInput"
        type="file"
        @change="handleFileUpload"
        class="hidden"
    />
    <div v-if="file" class="mt-2 text-sm text-blue-600">{{ file.name }}</div>
    <button
        @click.stop="submitFile"
        class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-semibold"
    >
        Upload
    </button>
    </div>


      <!-- Header tables -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-white">
          Daftar Dokumen
        </h2>
      </div>

      <!-- Tabel Dokumen -->
      <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="max-w-full overflow-x-auto">
          <table class="min-w-full table-fixed text-left">
            <thead>
              <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="w-12 px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">No</p>
                </th>
                <th class="px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Nama Dokumen</p>
                </th>
                <th class="px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Tanggal Upload</p>
                </th>
                <th class="px-5 py-3 sm:px-6">
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Aksi</p>
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
              <tr v-for="(doc, index) in documents" :key="doc.id">
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ index + 1 }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.filename }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.uploaded_at }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex space-x-4">
                    <button
                      class="text-blue-600 hover:underline dark:text-blue-400"
                    >
                      Lihat
                    </button>
                    <button
                      class="text-red-600 hover:underline dark:text-red-400"
                    >
                      Hapus
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="documents.length === 0">
                <td colspan="3" class="text-center px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
                  Belum ada dokumen yang diupload.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
