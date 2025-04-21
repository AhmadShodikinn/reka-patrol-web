<script setup lang="ts">
import AppSidebar from '@/Components/Layout/AppSidebar.vue';
import { useSidebar } from '@/Composables/useSidebar';
import Backdrop from '@/Components/Layout/Backdrop.vue';
import AppHeader from '@/Components/Layout/AppHeader.vue';
const { isExpanded, isHovered } = useSidebar()

</script>

<template>
    <div class="min-h-screen bg-background">
        <div class="min-h-screen xl:flex">
            <AppSidebar />
            <Backdrop />
            <div class="flex-1 transition-all duration-300 ease-in-out"
                :class="[isExpanded || isHovered ? 'lg:ml-[290px]' : 'lg:ml-[90px]']">
                <AppHeader />
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
