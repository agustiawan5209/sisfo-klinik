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
                <div class="h-full w-full absolute top-0 left-0 z-0">
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
                    <p class="text-lg mt-4 font-semibold">Ahli Gigi Sulawesi </p>
                    <p class="mt-2 leading-relaxed">Selalu
                        Melayani pembuatan dan pemasangan Gigi palsu yang berkualitas dan bergaransi.</p>
                </div>

                <div class="w-full lg:w-1/2 lg:px-8 mt-12 lg:mt-0">
                    <div class="md:flex">
                        <div>
                            <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="md:ml-8 mt-4 md:mt-0">
                            <h4 class="text-xl font-bold leading-tight">Semua yang Anda Butuhkan</h4>
                            <p class="mt-2 leading-relaxed">
                                Layanan kami yang komprehensif memungkinkan Anda untuk mendapatkan semua perawatan gigi yang dibutuhkan di sini, di kantor kami yang canggih - mulai dari pembersihan dan penambalan gigi hingga implan dan pencabutan gigi.</p>
                        </div>
                    </div>

                    <div class="md:flex mt-8">
                        <div>
                            <div class="w-16 h-16 bg-blue-600 rounded-full"></div>
                        </div>
                        <div class="md:ml-8 mt-4 md:mt-0">
                            <h4 class="text-xl font-bold leading-tight">Penanganan Pasien</h4>
                            <p class="mt-2 leading-relaxed">
                                Rencana perawatan Anda akan disesuaikan dengan kebutuhan, gaya hidup, dan tujuan Anda. Bahkan jika sudah bertahun-tahun sejak terakhir kali Anda mengunjungi dokter gigi, kami dapat membantu Anda. Kantor kami yang nyaman, tim kami yang penuh kasih, dan perawatan invasif minimal akan membantu Anda merasa nyaman.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex md:flex-wrap mt-24 text-center md:-mx-4">
                <div class="md:w-1/2 md:px-4 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/teeth-whitening.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Pemutihan Gigi</h4>
                        <p class="mt-1">Gigi kusam dapat menurunkan rasa percaya diri. Pemutihan gigi adalah solusi untuk mendapatkan senyum cerah berkilau</p>
                        <!-- <a href="#" class="block mt-4">Read More</a> -->
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/oral-surgery.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Pemeriksaan Gigi</h4>
                        <p class="mt-1">Pemeriksaan gigi rutin adalah kunci untuk menjaga kesehatan gigi dan mulut. Pemeriksaan ini membantu mendeteksi dan mencegah masalah gigi sejak dini, seperti gigi berlubang, penyakit gusi, dan kanker mulut.</p>
                        <!-- <a href="#" class="block mt-4">Read More</a> -->
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/painless-dentistry.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">Perawatan Dengan Ahlinya</h4>
                        <p class="mt-1">Perawatan gigi oleh dokter gigi ahli sangat penting untuk menjaga kesehatan gigi dan mulut.</p>
                        <!-- <a href="#" class="block mt-4">Read More</a> -->
                    </div>
                </div>

                <div class="md:w-1/2 md:px-4 mt-4 md:mt-8 lg:mt-0 lg:w-1/4">
                    <div class="bg-white rounded-lg border border-gray-300 p-8">
                        <img src="images/periodontics.svg" alt="" class="h-20 mx-auto">

                        <h4 class="text-xl font-bold mt-4">periodontologi</h4>
                        <p class="mt-1">Periodonsia atau periodontologi merupakan cabang dari ilmu kedokteran gigi yang mempelajari tentang struktur pendukung gigi, termasuk penyakit dan kondisi yang mempengaruhinya.</p>
                        <!-- <a href="#" class="block mt-4">Read More</a> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- end about -->

        <!-- start testimonials -->
        <!-- <section class="relative bg-gray-100 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-16 lg:py-32">
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
        </section> -->
        <!-- end testimonials -->

        <!-- start cta -->
        <section
            class="relative bg-blue-teal-gradient px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 py-12 text-center md:text-left">
            <div class="md:flex md:items-center md:justify-center">
                <h2 class="text-xl font-bold text-white">Dapatkan Layanan Anda Hari ini! <br class="block md:hidden">Hubungi Kami
                    : +62 812-4275-5965</h2>
                <Link :href="route('login')"
                    class="px-8 py-4 bg-white text-blue-600 rounded inline-block font-semibold md:ml-8 mt-4 md:mt-0">Daftar Sekarang</Link>
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
