<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChartJenisImunisasi from '@/Components/Chart/ChartJenisImunisasi.vue';
import LaporanCardTable from '@/Components/Card/LaporanCardTable.vue';
import Dropdown from '@/Components/Dropdown.vue';

import { ref, watch, defineProps } from 'vue';
const props = defineProps({
    search: {
        type: String,
        default: '',
    },
    order: {
        type: String,
        default: '',
    },
    data: {
        type: Object,
        default: () => ({}),
    },
    table_colums: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
})
const crud = ref({
    tambah: props.can.add,
    edit: props.can.edit,
    show: false,// props.can.show,
    delete: props.can.delete,
    reset_password: props.can.reset,

})

</script>

<template>

    <Head title="Pasien" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Pasien</h2>
        </template>

        <div class="py-4 relative box-content">
            <LaporanCardTable @update:search="search = $event" @update:order="order" :slug="null" path="Pasien" :TableData="data" :tableColums="table_colums" :crud="crud" />
        </div>
    </AuthenticatedLayout>
</template>
