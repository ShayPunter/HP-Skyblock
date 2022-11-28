<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <header class="bg-gray-800">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
                <div class="flex items-center">
                    <div class="ml-10 hidden space-x-8 lg:block">
                        <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Solutions</a>

                        <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Pricing</a>

                        <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Docs</a>

                        <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Company</a>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap justify-center space-x-6 py-4 lg:hidden">
                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Solutions</a>

                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Pricing</a>

                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Docs</a>

                <a href="#" class="text-base font-medium text-white hover:text-indigo-50">Company</a>
            </div>
        </nav>
    </header>

    <main class="mx-auto max-w-7xl mt-5 mb-5 flex flex-col w-full justify-center">
        <!-- Profile Overview -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <!-- Profile Name -->
                <h2 class="font-bold text-2xl">Viewing user <span class="text-blue-500">xShay_</span></h2>
                <p class="text-sm">Profile: Pomegranate</p>

                <img src="https://mc-heads.net/body/30e4e490f8424ec986304c597030adc8" />

            </div>
            <div>
                <h2 class="font-bold text-2xl">Profile Overview</h2>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <apexchart v-for="chart in charts" :width="chart.width" :height="chart.height" :type="chart.type" :options="chart.options" :series="chart.series"></apexchart>
        </div>
    </main>
</template>

<script>
export default {
    props: {
        charts: Object
    }
}
</script>
