<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar/Sidebar.vue';

const showingNavigationDropdown = ref(false);
const Page = usePage().props.auth;
const Roles = Page.role;
function roleToCheck(role) {
    if (Array.isArray(Roles)) {
        return Roles.includes(role)
    }else{
        return false;
    }
}

function ArrayToString(){
    if (Array.isArray(Roles)) {
        return Roles.reduce((a,b)=>{

            return String(a+ ','+b).toString();
        })
    }
}
</script>
<template>
    <ul class="mt-6" v-if="roleToCheck('Admin')">
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
        <li class="relative px-6 py-3">
            <NavLink :href="route('Admin.Antrian.index')" :active="route().current('Admin.Antrian.index')">
                <font-awesome-icon :icon="['fas', 'file']"/>
                <span class="ml-4">Antrian</span>
            </NavLink>
        </li>
        <li class="relative px-6 py-3">
            <NavLink :href="route('Pemeriksaan.index')" :active="route().current('Pemeriksaan.index')">
                <font-awesome-icon :icon="['fas', 'search']"/>
                <span class="ml-4">Pemeriksaan</span>
            </NavLink>
        </li>
        <li class="relative px-6 py-3">
            <NavLink :href="route('Laporan.index')" :active="route().current('Laporan.index')">
                <font-awesome-icon :icon="['fas', 'file-pdf']"/>
                <span class="ml-4">Laporan</span>
            </NavLink>
        </li>
    </ul>
    <ul class="mt-6" v-if="roleToCheck('Pasien')">
        <li v-if="roleToCheck('Pasien')">
            <NavLink :href="route('dashboard.pengguna')" :active="route().current('dashboard.pengguna')" >
                <font-awesome-icon :icon="['fas', 'home']"/>

                <span class="ml-4">Dashboard</span>
            </NavLink>
        </li>
    </ul>
</template>
