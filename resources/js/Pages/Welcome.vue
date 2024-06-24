<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

</script>

<template>

    <Head title="Welcome" />
    <HomeLayout class="w-full">
          <!-- start hero -->
          <div class="bg-gray-100">
            <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 overflow-hidden py-48 flex
          items-center min-h-screen">
                <div class="h-full absolute top-0 left-0 z-0">
                    <img src="images/cover-bg.jpg" alt="" class="w-full h-full object-cover opacity-20">
                </div>

                <div class="lg:w-3/4 xl:w-2/4 relative z-10 h-100 lg:mt-16">
                    <div>
                        <h1 class="text-white text-xl md:text-2xl xl:text-5xl font-bold leading-tight">SISTEM PENGELOLAAN DATA
                            PEMERIKSAAN GIGI</h1>
                        <p class="text-blue-100 text-xl md:text-2xl leading-snug mt-4">
                            KLINIK FAHRI DENT KOTA MAKASSAR</p>
                        <a href="#"
                            class="px-8 py-4 bg-teal-500 text-white rounded inline-block mt-8 font-semibold">
                        Pendaftaran Antrian
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <!-- end hero -->

        <!-- start about -->
        <section class="relative px-4 py-16 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 lg:py-32">
            <div class="flex flex-col lg:flex-row lg:-mx-8">
                <div class="w-full lg:w-1/2 lg:px-8">
                    <h2 class="text-3xl leading-tight font-bold mt-4">Selamat Datang Di Website KLINIK FAHRI DENT KOTA MAKASSAR
                    </h2>
                    <p class="text-lg mt-4 font-semibold">Excellence in Dentistry in the Heart of NY</p>
                    <p class="mt-2 leading-relaxed">Donec convallis sollicitudin facilisis. Integer nisl ligula,
                        accumsan non
                        tincidunt ac, imperdiet in enim.
                        Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a,
                        faucibus mi.</p>
                </div>

                <div class="w-full lg:w-1/2 lg:px-8 mt-12 lg:mt-0">
                    <div class="md:flex">
                        <div>
                            <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="md:ml-8 mt-4 md:mt-0">
                            <h4 class="text-xl font-bold leading-tight">Everything You Need Under One Roof</h4>
                            <p class="mt-2 leading-relaxed">Our comprehensive services allow you to receive all needed
                                dental care
                                right here in our state-of-art
                                office – from dental cleanings and fillings to dental implants and extractions.</p>
                        </div>
                    </div>

                    <div class="md:flex mt-8">
                        <div>
                            <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="md:ml-8 mt-4 md:mt-0">
                            <h4 class="text-xl font-bold leading-tight">Our Patient-Focused Approach</h4>
                            <p class="mt-2 leading-relaxed">Your treatment plan will perfectly match your needs,
                                lifestyle, and goals.
                                Even if it’s been years
                                since you last visited the dentist, we can help. Our comfortable office, compassionate
                                team, and
                                minimally-invasive treatments will help you feel completely at ease.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex md:flex-wrap mt-24 text-center md:-mx-4">
                <div class="md:w-1/2 md:px-4 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/teeth-whitening.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Teeth Whitening</h4>
                        <p class="mt-1">Let us show you how our experience.</p>
                        <a href="#" class="block mt-4">Read More</a>
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/oral-surgery.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Oral Surgery</h4>
                        <p class="mt-1">Let us show you how our experience.</p>
                        <a href="#" class="block mt-4">Read More</a>
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/painless-dentistry.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Painless Dentistry</h4>
                        <p class="mt-1">Let us show you how our experience.</p>
                        <a href="#" class="block mt-4">Read More</a>
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/periodontics.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Periodontics</h4>
                        <p class="mt-1">Let us show you how our experience.</p>
                        <a href="#" class="block mt-4">Read More</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- end about -->

        <!-- start testimonials -->
        <section class="relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-16 lg:py-32">
            <div class="flex flex-col lg:flex-row lg:-mx-8">
                <div class="w-full lg:w-1/2 lg:px-8">
                    <h2 class="text-3xl leading-tight font-bold mt-4">Why choose the Mesothelioma Center?</h2>
                    <p class="mt-2 leading-relaxed">Aenean ut tellus tellus. Suspendisse potenti. Nullam tincidunt lacus
                        tellus,
                        sed aliquam est vehicula a. Pellentesque consectetur condimentum nulla, eleifend condimentum
                        purus vehicula
                        in. Donec convallis sollicitudin facilisis. Integer nisl ligula, accumsan non tincidunt ac,
                        imperdiet in
                        enim. Donec efficitur ullamcorper metus, eu venenatis nunc. Nam eget neque tempus, mollis sem a,
                        faucibus
                        mi.</p>
                </div>

                <div class="w-full md:max-w-md md:mx-auto lg:w-1/2 lg:px-8 mt-12 mt:md-0">
                    <div class="bg-gray-400 w-full h-72 rounded-lg"></div>

                    <p class="italic text-sm mt-2 text-center">Aenean ante nisi, gravida non mattis semper.</p>
                </div>
            </div>
        </section>
        <!-- end testimonials -->

        <!-- start cta -->
        <section
            class="relative bg-blue-teal-gradient px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-12 text-center md:text-left">
            <div class="md:flex md:items-center md:justify-center">
                <h2 class="text-xl font-bold text-white">Get in touch with us today! <br class="block md:hidden">Call us
                    on: +1
                    562-789-1935</h2>
                <a href="#"
                    class="px-8 py-4 bg-white text-blue-600 rounded inline-block font-semibold md:ml-8 mt-4 md:mt-0">Book
                    Appointment</a>
            </div>
        </section>
        <!-- end cta -->

    </HomeLayout>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
