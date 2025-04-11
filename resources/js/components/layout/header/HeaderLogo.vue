<template>
  <Link :href="route('dashboard')" class="lg:hidden">
    <img class="dark:hidden" src="assets/images/logo/logo.svg" alt="Logo" />
    <img class="hidden dark:block" src="assets/images/logo/logo-dark.svg" alt="Logo" />
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { RouterLink } from 'vue-router'
</script>
