<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { ref, defineProps, watch, onMounted } from 'vue';

const page = usePage();
const props = defineProps({
    pemeriksaan: {
        type: Object,
        default: () => ({})
    }
})

</script>

<template>

    <Head title="Pemeriksaan" />

    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Detail Pemeriksaan</h2>
        </template>

        <div class="md:py-4 relative box-content">
            <section class=" py-2 px-0 md:px-6  md:py-6 bg-gray-100 text-gray-900">
                <form novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full  ">
                                <ul class="flex flex-col space-y-20">
                                    <li class="flex gap-3 py-2 border-b">
                                        <span class="text-lg">Detail Data Pemeriksaan!!</span>
                                    </li>
                                </ul>

                                <table class="w-full table">
                                    <colgroup>
                                    <col class="w-32">
                                    <col class="w-3">
                                    <col>
                                    </colgroup>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize">Nama Pasien</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ pemeriksaan.nama_pasien }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize">Nama Layanan</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ pemeriksaan.nama_layanan }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize">Nama Petugas</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ pemeriksaan.nama_petugas  }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize">Tanggal Pemeriksaan</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600"> {{ pemeriksaan.tgl_pemeriksaan   }} </td>
                                    </tr>
                                    <tr class="">
                                        <td class="text-sm border-b py-2 font-bold capitalize">Hasil Pemeriksaan</td>
                                        <td>:</td>
                                        <td class="text-sm border-b text-gray-600">
                                            <p v-html="pemeriksaan.hasil_pemeriksaan"></p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </section>
        </div>
    </UserLayout>
</template>
