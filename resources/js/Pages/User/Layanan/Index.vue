<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref, watch, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps({
    search: {
        type: String,
        default: '',
    },
    order: {
        type: String,
        default: '',
    },
    layanan: {
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
    show: props.can.show,
    delete: props.can.delete,
    reset_password: props.can.reset,

})

const showModal = ref(false);
const btnModal = ref(false);

const formLayanan = useForm({
    id_pasien : '',
    id_layanan: '',
    tgl: '',
})

const getLayanan = async function(){
    axios.get(route(''))
}
</script>

<template>

    <Head title="Layanan" />

    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Layanan</h2>
        </template>



        <div class="py-4 relative box-content">
            <div class="w-full overflow-hidden rounded-lg shadow-xs divide-y divide-gray-700 bg-gray-800">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left uppercase border-b border-gray-700  text-gray-400 bg-gray-800">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Layanan</th>
                                <th class="px-4 py-3">keterangan</th>
                                <th class="px-4 py-3">harga</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y divide-gray-700 bg-gray-800" v-if="layanan.data.length">
                            <tr class="text-gray-400" v-for="(item, index) in layanan.data">
                                <td class="px-4 py-3">
                                    {{ (layanan.current_page - 1) * layanan.per_page + index + 1 }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                   {{item.nama_layanan}}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                   {{item.keterangan}}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full bg-green-700 text-green-100">
                                        {{ item.harga }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    6/10/2020
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="divide-y divide-gray-700 bg-gray-800" v-else>
                            <tr>
                                <td colspan="4" class="p-5 text-gray-400 text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="py-1 px-4 ">
                    <div class="flex flex-wrap">
                        <template v-for="(link, key) in layanan.links">
                            <div v-if="link.url === null" :key="key"
                                class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                                v-html="link.label" />
                            <Link v-else :key="`link-${key}`"
                                class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 active:border-blue-400 hover:bg-gray-200 border focus:border-indigo-500 rounded"
                                :class="{ 'bg-white border-blue-500 text-black': link.active }" preserve-state
                                preserve-scroll :data="{ search, order }" :href="link.url" v-html="link.label" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>
