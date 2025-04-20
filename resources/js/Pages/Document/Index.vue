<script setup lang="ts">
import { Head, router, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import Dropzone from '@/Components/forms/FormElements/Dropzone.vue';
import Alert from '@/Components/UI/Alert.vue';

const file = ref<File | null>(null);
const showAlert = ref(false);
const alertMessage = ref('');

const { props } = usePage();
const documentRes = props.documentRes as {
  data: Array<{
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

const handleFileUpload = async (file: File) => {
  const data = new FormData();
  data.append('file', file);

  await window.axios.post(route('documents.store'), data, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  }).then(() => {
    showAlert.value = true;
    alertMessage.value = 'Dokumen berhasil diupload. Tunggu sebentar...';
    setTimeout(() => {
      showAlert.value = false;
      alertMessage.value = '';
      router.visit(route('documents.index'));
    }, 1500);
  })
};

const deleteDocument = async (id: number) => {
  if (confirm('Apakah Anda yakin ingin menghapus dokumen ini?')) {
    await window.axios.delete(route('documents.destroy', id));
    router.visit(route('documents.index'));
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
      <Alert v-if="showAlert" variant="success" title="Upload Berhasil" :message="alertMessage"></Alert>

      <Dropzone :upload-url="route('documents.store')" :accepted-files="'.pdf,.doc,.docx'"
        :handle-file-upload="handleFileUpload">
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
      <div class="mb-6 mt-6">
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
              <tr v-for="(doc, index) in documentRes.data" :key="doc.id">
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ documentRes.meta.from + index }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.file_name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.user?.name }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">{{ doc.updated_at }}</td>
                <td class="px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
                  <div class="flex space-x-4">
                    <a :href="`/storage/${doc.file_path}`" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">
                      Lihat
                    </a>
                    <button class="text-red-600 hover:underline dark:text-red-400" @click="deleteDocument(doc.id)">
                      Hapus
                    </button>
                  </div>
                </td>
              </tr>
              <tr v-if="!(documentRes.data.length > 0)">
                <td colspan="4" class="text-center px-5 py-4 sm:px-6 text-sm text-gray-500 dark:text-gray-400">
                  Belum ada dokumen yang diupload.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800 sm:px-6">
          <div class="flex flex-1 justify-between sm:hidden">
            <button :disabled="!documentRes.links.prev" @click="router.visit(documentRes.links.prev ?? '#')" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
              Previous
            </button>
            <button :disabled="!documentRes.links.next" @click="router.visit(documentRes.links.next ?? '#')" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
              Next
            </button>
          </div>
          <div class="hidden sm:flex sm:flex-1 sm:justify-between items-center">
            <div>
              <p class="text-sm text-gray-700 dark:text-gray-400">
                Menampilkan
                <span class="font-medium">{{ documentRes.meta.from ?? 1 }}</span>
                sampai
                <span class="font-medium">{{ documentRes.meta.to ?? 1 }}</span>
                dari
                <span class="font-medium">{{ documentRes.meta.total ?? 1 }}</span>
                hasil
              </p>
            </div>
            <div>
              <ul v-if="documentRes.meta.links.length > 3" class="inline-flex -space-x-px rounded-md">
                <li v-for="(link, index) in documentRes.meta.links" :key="index">
                  <button v-if="link.url" @click="router.visit(link.url)" :class="{ 'bg-blue-500 text-white': link.active, 'text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-700 dark:text-gray-400': !link.active }"
                    class="block px-3 py-2 text-sm font-medium" v-html="link.label"></button>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
