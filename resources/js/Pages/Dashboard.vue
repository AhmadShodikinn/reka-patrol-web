<script setup lang="ts">
import CustomerDemographic from '@/Components/ecommerce/CustomerDemographic.vue';
import EcommerceMetrics from '@/Components/ecommerce/EcommerceMetrics.vue';
import MonthlySale from '@/Components/ecommerce/MonthlySale.vue';
import MonthlyTarget from '@/Components/ecommerce/MonthlyTarget.vue';
import RecentOrders from '@/Components/ecommerce/RecentOrders.vue';
import StatisticsChart from '@/Components/ecommerce/StatisticsChart.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="grid grid-cols-12 gap-4 md:gap-6">
            <div class="col-span-12 space-y-6 xl:col-span-7">
                <EcommerceMetrics />
                <MonthlyTarget />
            </div>
            <div class="col-span-12 xl:col-span-5">
                <MonthlySale />
            </div>

            <div class="col-span-12">
                <StatisticsChart />
            </div>

            <div class="col-span-12 xl:col-span-5">
                <CustomerDemographic />
            </div>

            <div class="col-span-12 xl:col-span-7">
                <RecentOrders />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
