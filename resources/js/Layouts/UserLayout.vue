<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link, usePage } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

const User = usePage().props.auth.user
</script>

<template>
    <HomeLayout>

        <div class="bg-gray-100 rounded-xl">
            <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4  overflow-hidden py-32 flex
      items-center min-h-screen justify-center">

                <div class="container flex flex-row gap-7 mx-auto  rounded-xl shadow-xl pt-10">
                    <aside
                        class="group/sidebar flex flex-col shrink-0 lg:w-[20%] w-[250px] transition-all duration-300 ease-in-out m-0 z-40 bg-transparent border-r  border-r-neutral-200 bg-white rounded-lg "
                        id="sidenav-main">
                        <div class="flex items-center justify-between px-8 py-5">
                            <div class="flex items-center mr-5">
                                <div class="mr-2 ">
                                    <a href="javascript:void(0)"
                                        class=" hover:text-primary transition-colors duration-200 ease-in-out text-[1.075rem] font-medium ">{{
                                        User.name }}</a>
                                </div>
                            </div>
                            <a class="inline-flex relative items-center group justify-end text-base font-medium leading-normal text-center align-middle cursor-pointer rounded-[.95rem] transition-colors duration-150 ease-in-out text-dark bg-transparent shadow-none border-0"
                                href="javascript:void(0)">
                                <span
                                    class="leading-none transition-colors duration-200 ease-in-out peer shrink-0 group-hover:text-primary text-secondary-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                        </div>

                        <div class="hidden border-b  lg:block dark:border-neutral-700/70 border-neutral-200">
                        </div>

                        <div class="relative px-3 my-5 overflow-y-auto">
                            <div class="flex flex-col w-full font-medium space-y-4">

                                <!-- menu item -->
                                <div>
                                    <span
                                        class="select-none flex items-center px-4 bg-blue-600 py-2 rounded-md">
                                        <Link :href="route('dashboard.pengguna')"
                                            class="flex items-center flex-grow text-xs md:text-sm lg:text-base text-white ">Dashboard</Link>
                                    </span>
                                </div>
                                <!-- <div>
                                    <span
                                        class="select-none flex items-center px-4 bg-blue-600 py-2 rounded-md">
                                        <Link :href="route('User.Layanan.index')"
                                            class="flex items-center flex-grow text-xs md:text-sm lg:text-base text-white ">Daftar
                                            Layanan</Link>
                                    </span>
                                </div> -->
                                <div>
                                    <span
                                        class="select-none flex items-center px-4 bg-blue-600 py-2 rounded-md">
                                        <Link :href="route('User.Antrian.index')"
                                            class="flex items-center flex-grow text-xs md:text-sm lg:text-base text-white ">Data
                                            Antrian</Link>
                                    </span>
                                </div>
                                <div>
                                    <span
                                        class="select-none flex items-center px-4 bg-blue-600 py-2 rounded-md">
                                        <Link :href="route('User.Pemeriksaan.index')"
                                        class="flex items-center flex-grow text-xs md:text-sm lg:text-base text-white ">Laporan
                                        Pemeriksaan</Link>
                                    </span>
                                </div>


                            </div>
                        </div>
                    </aside>
                    <div class=" w-[80%] relative pt-3">
                        <slot />
                    </div>
                </div>
            </section>
        </div>
    </HomeLayout>
</template>
