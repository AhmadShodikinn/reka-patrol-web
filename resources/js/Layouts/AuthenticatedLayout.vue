<script setup lang="ts">
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import AppSidebar from '@/Components/Layout/AppSidebar.vue';
import { useSidebar } from '@/Composables/useSidebar';
import Backdrop from '@/Components/Layout/Backdrop.vue';
import AppHeader from '@/Components/Layout/AppHeader.vue';
const { isExpanded, isHovered } = useSidebar()

const showingNavigationDropdown = ref(false);
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
