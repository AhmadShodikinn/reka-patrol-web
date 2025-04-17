<script setup lang="ts">
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import FullScreenLayout from '@/Components/Layout/FullScreenLayout.vue';
import CommonGridShape from '@/Components/Common/CommonGridShape.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <FullScreenLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
            <div class="relative flex flex-col justify-center w-full h-screen lg:flex-row dark:bg-gray-900">
                <div class="flex flex-col flex-1 w-full lg:w-1/2">
                    <div class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto">
                        <div>
                            <div class="mb-5 sm:mb-8">
                                <h1
                                    class="mb-2 font-semibold text-gray-800 text-title-sm dark:text-white/90 sm:text-title-md">
                                    Sign In
                                </h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Enter your email and password to sign in!
                                </p>
                            </div>
                            <div>
                                <form @submit.prevent="submit">
                                    <div>
                                        <InputLabel for="email" value="Email" />

                                        <TextInput id="email" type="email" class="mt-1 block w-full"
                                            v-model="form.email" required autofocus autocomplete="username" />

                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>

                                    <div class="mt-4">
                                        <InputLabel for="password" value="Password" />

                                        <TextInput id="password" type="password" class="mt-1 block w-full"
                                            v-model="form.password" required autocomplete="current-password" />

                                        <InputError class="mt-2" :message="form.errors.password" />
                                    </div>

                                    <div class="mt-4 block">
                                        <label class="flex items-center">
                                            <Checkbox name="remember" v-model:checked="form.remember" />
                                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                        </label>
                                    </div>

                                    <div class="mt-4 flex items-center justify-end">
                                        <Link v-if="canResetPassword" :href="route('password.request')"
                                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Forgot your password?
                                        </Link>

                                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                            Log in
                                        </PrimaryButton>
                                    </div>
                                </form>
                                <div class="mt-5">
                                    <p
                                        class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
                                        Don't have an account?
                                        <Link :href="route('register')" class="text-brand-500 hover:text-brand-600 dark:text-brand-400">
                                            Sign Up
                                        </Link>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative items-center hidden w-full h-full lg:w-1/2 bg-brand-950 dark:bg-white/5 lg:grid">
                    <div class="flex items-center justify-center z-1">
                        <CommonGridShape />
                        <div class="flex flex-col items-center max-w-sm">
                            <div class="flex items-center mb-4">
                                <Link :href="route('welcome')" class="mr-4">
                                    <img src="/images/logo/Asset 2@3x.png"
                                        alt="Logo"/>
                                        <!-- rapaham nyilikno piye🗿 -->
                                </Link>
                                <Link :href="route('welcome')" class="block">
                                    <img src="/images/logo/logos.png" alt="Logo" />
                                </Link>
                            </div>
                            <p class="text-center text-gray-400 dark:text-white/60">
                                By Pangeran 2025
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </FullScreenLayout>
</template>
