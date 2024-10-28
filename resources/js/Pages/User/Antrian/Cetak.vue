<script setup>
import { ref, defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
const props = defineProps({
    layanan:{
        type: Object,
        default:()=>({})
    }
});

// Ref untuk menangani elemen yang ingin dicetak
const printRef = ref(null);

// Fungsi cetak elemen tertentu
const printElement = () => {
    const printContent = printRef.value; // Dapatkan elemen berdasarkan ref
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
        <html>
            <head>
                <title>Cetak Layanan</title>
                <style>
                    /* Tambahkan CSS yang diperlukan untuk mencetak */
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h1 { font-size: 24px; }
                    .text-3xl { font-size: 1.875rem; }
                    .text-body-text { font-size: 1rem; }
                    .text-dark { font-weight: bold; }
                </style>
            </head>
            <body>
                ${printContent.innerHTML}  <!-- Ambil HTML dari elemen yang di-refer -->
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
};
</script>

<template>
    <Head title="Cetak Layanan"/>
    <div>
        <!-- Tombol untuk mencetak -->
        <button @click="printElement" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Cetak
        </button>
        <div class="container" ref="printRef">
            <div class="w-full">
                <div class="card">  <!-- Tambahkan ref di sini -->
                    <h1
                        class="relative flex justify-between items-center sm:py-6 py-5 sm:px-[1.875rem] px-4 flex-wrap border-b border-border text-body-text text-3xl">
                        Klinik Fahri Dent
                        <p>{{ layanan.tgl }}</p>
                    </h1>
                    <div class="flex justify-center items-center">
                        <div class="w-[60%] sm:p-[1.875rem] p-4 border">
                            <div class="row mb-12">
                                <div class="mt-6 w-full">
                                    <h6 class="mb-2 ">Data:</h6>
                                    <div class="text-3xl">Nomor Antrian : <strong class="text-dark "> {{ layanan.nomor_antrian }} </strong> </div>
                                    <div class="text-body-text">Nama Pasien : {{ layanan.nama_pasien }}</div>
                                    <div class="text-body-text">Nama Layanan : {{ layanan.nama_layanan }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
