<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                Informasi Profil Akun
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                <!-- Update your account's profile information and email address. -->
                Perbarui informasi profil dan alamat email akun Anda.
            </p>
        </header>

        <form
            @submit.prevent="form.patch(route('profile.update'))"
            class="mt-6 space-y-6"
        >
            <!-- Name Field -->
            <div>
                <InputLabel for="name" value="Nama" class="text-gray-700 dark:text-gray-300" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2 text-red-600 dark:text-red-400" :message="form.errors.name" />
            </div>

            <!-- Email Field -->
            <div>
                <InputLabel for="email" value="Email" class="text-gray-700 dark:text-gray-300" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2 text-red-600 dark:text-red-400" :message="form.errors.email" />
            </div>

            <!-- Email Verification -->
            <!-- <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                    Alamat email Anda belum diverifikasi.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:ring-indigo-400"
                    >
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600 dark:text-green-400"
                >
                    Link verifikasi baru telah dikirimkan ke alamat email Anda.
                </div>
            </div> -->

            <!-- Save Button -->
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing" class="dark:bg-blue-600 dark:hover:bg-blue-500 dark:focus:ring-blue-400">
                    Simpan
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >
                        Tersimpan.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
