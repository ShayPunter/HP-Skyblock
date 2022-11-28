<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

const log = axios.get('/collection/0b764e48721f436d84535d1719a19518/30e4e490f8424ec986304c597030adc8/LOG').data;
const cobblestone = axios.get('/collection/0b764e48721f436d84535d1719a19518/30e4e490f8424ec986304c597030adc8/COBBLESTONE').data;
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        {{ log }}

        {{ cobblestone }}
    </div>
</template>
