<script setup>
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
</script>
<template>
    <ul class="mt-6">
        <li class="relative px-6 py-3">

            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span class="ml-4">Dashboard</span>
            </NavLink>
        </li>
        <li class="relative px-6 py-3">
            <NavLink :href="route('Pasien.index')" :active="route().current('Pasien.index')">
                <font-awesome-icon :icon="['fas', 'file']"/>
                <span class="ml-4">Pasien</span>
            </NavLink>
        </li>
        <li class="relative px-6 py-3">
            <NavLink :href="route('Layanan.index')" :active="route().current('Layanan.index')">
                <font-awesome-icon :icon="['fas', 'pen']"/>
                <span class="ml-4">Layanan</span>
            </NavLink>
        </li>
    </ul>
</template>
