<template>
  <ThemeProvider>
    <SidebarProvider>
      <RouterView />
    </SidebarProvider>
  </ThemeProvider>
</template>

<script setup lang="ts">
import ThemeProvider from '@/Components/Layout/ThemeProvider.vue'
import SidebarProvider from '@/Components/Layout/SidebarProvider.vue'
</script>
