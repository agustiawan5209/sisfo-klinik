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
    <div class="aside-anime">

        <div class="hidden md:block mt-8 text-center">
            <ApplicationLogo class="m-auto h-10 w-10 rounded-md object-cover lg:h-12 lg:w-12" />
            <h5 class="mt-4 text-xl font-semibold text-gray-600 lg:block">{{ $page.props.auth.user.name }}
            </h5>
            <span class=" text-gray-400 lg:block">{{ ArrayToString() }}</span>
        </div>

        <ul class="mt-8 space-y-1 tracking-wide text-sm">
            <li v-if="roleToCheck('Kader') || roleToCheck('Kepala')">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" :icon="['fas', 'home']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Orang Tua')">
                <NavLink :href="route('dashboard.pengguna')" :active="route().current('dashboard.pengguna')" :icon="['fas', 'home']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Kepala')">
                <NavLink :href="route('Posyandus.index')"
                    :active="route().current('Posyandus.index') || route().current('Posyandus.create') || route().current('Posyandus.edit') || route().current('Posyandus.show')"
                    :icon="['fas', 'house-medical-flag']">
                    <span class="group-hover:text-gray-700 capitalize">Data Posyandu</span>
                </NavLink>
            </li>

            <li v-if="roleToCheck('Kader') || roleToCheck('Kepala')">
                <NavLink :href="route('Pegawai.index')"
                    :active="route().current('Pegawai.index') || route().current('Pegawai.create') || route().current('Pegawai.edit') || route().current('Pegawai.show')"
                    :icon="['fas', 'user-group']">
                    <span class="group-hover:text-gray-700 capitalize">Staff Posyandu</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Kader') || roleToCheck('Kepala')">
                <NavLink :href="route('OrangTua.index')"
                    :active="route().current('OrangTua.index') || route().current('OrangTua.create') || route().current('OrangTua.edit') || route().current('OrangTua.show')"
                    :icon="['fas', 'users-line']">

                    <span class="group-hover:text-gray-700 capitalize">Orang Tua</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Kader') || roleToCheck('Kepala') || roleToCheck('Orang Tua')">
                <NavLink :href="route('Jadwal.index')"
                    :active="route().current('Jadwal.index') || route().current('Jadwal.create') || route().current('Jadwal.edit') || route().current('Jadwal.show')"
                    :icon="['far', 'calendar-days']">
                    <span class="group-hover:text-gray-700 capitalize">Jadwal Imunisasi</span>
                </NavLink>
            </li>

            <!-- <li v-if="roleToCheck('Kader') || roleToCheck('Kepala')">
                <NavLink href="#" :icon="['fas','chart-pie']">
                    <span class="group-hover:text-gray-700 capitalize">Data Balita Dan Ibu Hamil</span>
                </NavLink>
            </li> -->
            <li v-if="roleToCheck('Kader') || roleToCheck('Orang Tua')">
                <NavLink :href="route('Balita.index')"
                    :active="route().current('Balita.index') || route().current('Balita.create') || route().current('Balita.edit') || route().current('Balita.show')"
                    :icon="['fas', 'person-breastfeeding']">
                    <span class="group-hover:text-gray-700 capitalize">Data Balita</span>
                </NavLink>
            </li>
            <li v-if="roleToCheck('Kader') || roleToCheck('Orang Tua')">
                <NavLink :href="route('Riwayat.index')"
                    :active="route().current('Riwayat.index') || route().current('Riwayat.create') || route().current('Riwayat.edit') || route().current('Riwayat.show')"
                    :icon="['fas', 'folder-open']">
                    <span class="group-hover:text-gray-700 capitalize">Riwayat Imunisasi</span>
                </NavLink>
            </li>

            <li v-if="roleToCheck('Kepala') || roleToCheck('Orang Tua') ">
                <NavLink :href="route('Sertifikat.index')"
                    :active="route().current('Sertifikat.index') || route().current('Sertifikat.create') || route().current('Sertifikat.edit') || route().current('Sertifikat.show')"
                    :icon="['far', 'calendar-days']">
                    <span class="group-hover:text-gray-700 capitalize">Sertifikat Imunisasi</span>
                </NavLink>
            </li>
            <!-- Setting -->
            <li v-if="roleToCheck('Kepala')">
                <NavLink :href="route('SettingPuskesmas.create')" :icon="['fas', 'gears']">
                    <span class="group-hover:text-gray-700 capitalize">Pengaturan</span>
                </NavLink>
            </li>
        </ul>
    </div>
    <div class="-mx-6 flex items-center justify-between border-t px-6 pt-4">
        <NavLink :href="route('logout')" method="post" as="button" :icon="['fas', 'right-from-bracket']">
            <span class="group-hover:text-gray-700 capitalize">Logout</span>
        </NavLink>
    </div>
</template>
