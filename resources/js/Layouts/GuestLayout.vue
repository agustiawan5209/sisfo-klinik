<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

</script>

<template>
    <HomeLayout>

        <div class="bg-gray-100">
            <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 overflow-hidden py-48 flex
      items-center min-h-screen justify-center">
                <div class="h-full absolute top-0 left-0 z-0">
                    <img src="images/cover-bg.jpg" alt="" class="w-full h-full object-cover opacity-20">
                </div>

                <div class="bg-white p-4 rounded-lg z-50">
                <slot/>

                </div>
            </section>
        </div>
    </HomeLayout>
</template>
