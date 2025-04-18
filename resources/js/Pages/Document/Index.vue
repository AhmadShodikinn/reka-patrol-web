<script setup lang="ts">
import { Head, router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import Dropzone from '@/Components/forms/FormElements/Dropzone.vue';

const file = ref<File | null>(null);

// Mock data dokumen
// const documents = ref([
//   { id: 1, filename: 'SJA CUTTING.pdf', uploaded_at: '2025-04-01 09:30' },
//   { id: 2, filename: 'SJA WIRRING.docx', uploaded_at: '2025-04-10 14:22' },
// ]);

const { props } = usePage();
const documents = props.documents as Array<{
  id: number;
  user_id: number;
  user?: {
    id: number;
    name: string;
  }
  file_name: string;
  file_path: string;
  created_at: string;
  updated_at: string;
}>;

const handleFileUpload = async (file: File) => {
  const data = new FormData();
  data.append('file', file);

  await window.axios.post(route('documents.store'), data, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
  .then((response) => {
    router.visit(route('documents.index'));
  })
};

const deleteDocument = (id: number) => {
  if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
    router.delete(`/documents/${id}`);
    router.visit('/documents');
  }
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

      <Dropzone :upload-url="route('documents.store')" :accepted-files="'.pdf,.doc,.docx'" :handle-file-upload="handleFileUpload">
        <template #title>
          Klik untuk memilih dokumen yang ingin diupload
        </template>
        <template #description>
          Cari dan pilih dokumen yang ingin diupload
        </template>
        <template #button>
          Cari File
        </template>
      </Dropzone>

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
                  <p class="font-medium text-gray-500 text-xs dark:text-gray-400">Oleh</p>
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
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.file_name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.user?.name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.updated_at }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
                  <div class="flex space-x-4">
                    <button class="text-blue-600 hover:underline dark:text-blue-400">
                      Lihat
                    </button>
                    <button class="text-red-600 hover:underline dark:text-red-400" @click="deleteDocument(doc.id)">
                      Hapus
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="!(documents?.length > 0)">
                <td colspan="4" class="text-center px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
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
