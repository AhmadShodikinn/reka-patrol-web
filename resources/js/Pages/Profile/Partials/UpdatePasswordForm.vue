<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value?.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value?.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">
                Perbarui Kata Sandi
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Pastikan kata sandi Anda panjang dan unik untuk menjaga keamanan akun Anda.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <!-- Current Password Field -->
            <div>
                <InputLabel
                    for="current_password"
                    value="Password Saat Ini"
                    class="text-gray-700 dark:text-gray-300"
                />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    autocomplete="current-password"
                />

                <InputError
                    :message="form.errors.current_password"
                    class="mt-2 text-red-600 dark:text-red-400"
                />
            </div>

            <!-- New Password Field -->
            <div>
                <InputLabel
                    for="password"
                    value="Password Baru"
                    class="text-gray-700 dark:text-gray-300"
                />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password"
                    class="mt-2 text-red-600 dark:text-red-400"
                />
            </div>

            <!-- Confirm Password Field -->
            <div>
                <InputLabel
                    for="password_confirmation"
                    value="Konfirmasi Password Baru"
                    class="text-gray-700 dark:text-gray-300"
                />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white dark:focus:border-blue-400 dark:focus:ring-blue-400"
                    autocomplete="new-password"
                />

                <InputError
                    :message="form.errors.password_confirmation"
                    class="mt-2 text-red-600 dark:text-red-400"
                />
            </div>

            <!-- Save Button -->
            <div class="flex items-center gap-4">
                <PrimaryButton
                    :disabled="form.processing"
                    class="dark:bg-blue-600 dark:hover:bg-blue-500 dark:focus:ring-blue-400"
                >
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
