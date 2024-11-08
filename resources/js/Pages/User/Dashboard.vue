<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChartPertumbuhanPengguna from '@/Components/Chart/ChartPertumbuhanPengguna.vue';
import CardCalendar from '@/Components/Card/CardCalendar.vue';
import ChartJumlah from '@/Components/Chart/ChartJumlah.vue';
import HeaderStats from '@/Components/Header/HeaderStats.vue';
import { defineProps } from "vue";

const props = defineProps({
    pengguna: Number,
    balita: Number,

});
</script>

<template>

    <Head title="Dashboard Pasien" />

    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Pasien</h2>
        </template>

        <div class="w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="grid grid-cols-1 2xl:grid-cols-2 gap-7 p-2 place-content-end">
                <div class=" p-3 flex justify-center items-center relative">
                    <!-- <div class="w-full absolute bg-center left-1/4 z-0 opacity-45">
                        <img :src="'/svg/cartoon.svg'" alt="dashboard img" class="w-1/2 object-contain" />

                    </div> -->
                    <h1
                        class="w-full mb-5 text-xs sm:text-sm md:text-base lg:text-2xl text-center font-bold capitalize !leading-[1.208] text-black z-10">
                        Selamat Datang Di
                        <span class="text-base-light">Sistem Informasi </span>
                        PENGELOLAAN DATA
                        PEMERIKSAAN GIGI BERBASIS WEB DI KLINIK FAHRI DENT KOTA
                        MAKASSAR
                    </h1>


                </div>
                <div class="relative container flex flex-col justify-center items-center">
                    <div class="w-2/4 max-w-xl">
                        <div class="w-max">
                            <h3 class=" text-xs text-black md:text-base lg:text-lg font-semibold text-center">Kalender
                                Daftar Layanan</h3>
                            <CardCalendar />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
