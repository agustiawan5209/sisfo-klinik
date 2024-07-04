<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
    layanan:{
        type: Object,
        default:()=>({})
    }
});

</script>
<template>
    <div>
        <div class="row">
            <div class="xl:w-9/12">
                <div class="card">
                    <h1
                        class="relative flex justify-between items-center sm:py-6 py-5 sm:px-[1.875rem] px-4 flex-wrap border-b border-border text-body-text text-3xl">
                        Klinik Fahri Dent K
                        <p>{{ layanan.tgl }}</p>
                    </h1>
                <div class="flex justify-center items-center">
                    <div class="w-[60%] sm:p-[1.875rem] p-4 border">
                        <div class="row mb-12">
                            <div class="mt-6 w-full">
                                <h6 class="mb-2 ">Data:</h6>
                                <div class="text-3xl">Nomor Antrian : <strong class="text-dark "> {{ layanan.nomor_antrian }} </strong> </div>
                                <div class="text-body-text">Nama Pasien : {{layanan.nama_pasien}}</div>
                                <div class="text-body-text">Nama Layanan : {{layanan.nama_layanan}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
