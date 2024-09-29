<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import { ref, watch, defineProps, onMounted, inject } from 'vue';
import axios from 'axios';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
const swal = inject('$swal')

const page = usePage()

onMounted(() => {
    if (page.props.message !== null) {
        swal({
            icon: "info",
            title: 'Berhasil',
            text: page.props.message,
            showConfirmButton: true,
            timer: 2000
        });
    }
})
function messageDisplay(message, icon) {
    swal({
        icon: icon,
        title: 'Perhatian!!',
        text: message,
        showConfirmButton: true,
        timer: 2000
    });
}
const props = defineProps({
    search: {
        type: String,
        default: '',
    },
    order: {
        type: String,
        default: '',
    },
    date: {
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

const Form = useForm({
    search: props.search,
    date: props.date,
    order: props.order,
})

const search = ref(props.search)
const order = ref(props.order)
const date = ref(props.date)

// Filter By

watch(search, (value) => {
    Form.search = value
    Form.get(route('Admin.Antrian.index'), {
        preserveScroll: true,
        preserveState: true,
    })
})
watch(order, (value) => {
    Form.order = value
    Form.get(route('Admin.Antrian.index'), {
        preserveScroll: true,
        preserveState: true,
    })
})
watch(date, (value) => {
    Form.date = value
    Form.get(route('Admin.Antrian.index'), {
        preserveScroll: true,
        preserveState: true,
    })
})

function resetFilter(){
    search.value = '';
    date.value = '';
}
//
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
    slug: '',
    status: '',
    jam_pemeriksaan: '',
})

const getLayanan = function (item) {
    showModal.value = true;
    formLayanan.slug = item.id;
    formLayanan.status = item.status;
    formLayanan.jam_pemeriksaan = item.jam_pemeriksaan;
}

function submit() {
    formLayanan.put(route('Admin.Antrian.update'), {
        preserveState: false,
        onError: (err) => {
            var ul = "";
            for (const key in err) {
                ul += err[key] + '\n';

            }
            // err.forEach((element,key)=>{
            // })
            messageDisplay(ul, 'error');
        },
        onFinish: () => {
            showModal.value = false;
        }

    })
}
</script>

<template>

    <Head title="Antrian" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-900 leading-tight">Data Antrian</h2>
        </template>


        <Modal :show="showModal" maxWidth="md">
            <div class="w-full flex flex-col justify-center items-center py-4">
                <div class="text-gray-900 text-center">
                    <h3 class="text-xl md:text-2xl">Form update</h3>
                    <p class="text-justify text-sm">Update status antrian<br>
                        Lakukan Konfirmasi nomor antrian untuk pasien</p>
                </div>
                <form action="" @submit.prevent="submit" class="w-full md:w-[70%] border p-4 rounded-lg my-10">
                    <div class="col-span-full sm:col-span-2">
                        <label for="jam_pemeriksaan" class="text-sm">Jam Pemeriksaan</label>
                        <TextInput id="jam_pemeriksaan" type="text" v-model="formLayanan.jam_pemeriksaan"
                            placeholder="00:00 WITA." class="w-full text-gray-900" />
                        <InputError :message="formLayanan.errors.jam_pemeriksaan" />

                    </div>
                    <div class="col-span-full sm:col-span-2">
                        <label for="Antrian" class="text-sm">Status Antrian</label>
                        <select id="Antrian" v-model="formLayanan.status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value='0'>Belum Dikonfirmasi</option>
                            <option value='1'>Konfirmasi (Konfirmasi antrian)</option>
                            <option value='2'>Selesai (Pelayanan Telah Selesai Dilakukan)</option>
                        </select>
                        <InputError :message="formLayanan.errors.status" />

                    </div>

                    <div class="mt-2 flex justify-center">
                        <PrimaryButton type="submit" class="bg-green-500 hover:bg-green-700">Update Status Layanan
                        </PrimaryButton>
                    </div>

                </form>
            </div>
        </Modal>
        <div class="py-4 relative box-content">
            <div class="w-full overflow-hidden rounded-lg shadow-xs divide-y divide-gray-700 bg-white">
                <div class="py-3 px-4 flex justify-between">
                    <div class="flex gap-4">
                        <div class="relative max-w-xs">
                            <label class="sr-only">Search</label>
                            <input type="search" name="hs-table-with-pagination-search"
                                id="hs-table-with-pagination-search" v-model="search"
                                class="pl-2 py-1 md:pl-8 md:py-2 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                placeholder="Cari Data.........">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <path d="m21 21-4.3-4.3"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="relative max-w-xs">
                            <label class="sr-only">Tanggal Layanan</label>
                            <input type="date" name="hs-table-with-pagination-date" id="hs-table-with-pagination-date"
                                v-model="date"
                                class="py-1 md:py-2 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        </div>
                        <div class="relative max-w-xs">
                            <button type="reset" @click="resetFilter()" class="py-1 md:py-2 border px-2 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">Reset</button>
                        </div>
                    </div>
                    <div class="relative max-w-xs flex items-center gap-2">
                        <label class="capitalize text-xs md:text-sm">Urutkan</label>

                        <select id="order" v-model="order"
                            class="px-2 py-1 md:px-3 md:py-2 placeholder-gray-400 border focus:outline-none sm:w-40 sm:text-sm border-gray-200 shadow-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none ">
                            <option value="">-----</option>
                            <option value="desc">Terbaru</option>
                            <option value="asc">Terlama</option>
                        </select>
                        <div class="absolute inset-y-0 end-3 flex items-center pointer-events-none ps-3">
                            <font-awesome-icon :icon="['fas', 'filter']" class="text-gray-400" />
                        </div>
                    </div>
                </div>
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left uppercase border-b border-gray-700  text-gray-900 bg-white">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">Nama Pasien | ID Pasien</th>
                                <th class="px-4 py-3">Nama Layanan | ID layanan</th>
                                <th class="px-4 py-3">Nomor Antrian </th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Jam Pemeriksaan</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y divide-gray-700 bg-white" v-if="layanan.data.length" :class="{ 'opacity-75 blur-sm': Form.processing }">
                            <tr class="text-gray-900" v-for="(item, index) in layanan.data">
                                <td class="px-4 py-3">
                                    {{ (layanan.current_page - 1) * layanan.per_page + index + 1 }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.nama_pasien }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.nama_layanan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.nomor_antrian }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.tgl }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.jam_pemeriksaan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <PrimaryButton type="button" @click="getLayanan(item)" :class="item.status == 0? '!bg-red-600':'!bg-blue-400'">
                                        {{ item.status_layanan }}
                                    </PrimaryButton>
                                </td>
                            </tr>
                        </tbody>
                        <tbody class="divide-y divide-gray-700 bg-gray-200" v-else>
                            <tr>
                                <td colspan="7" class="p-5 text-gray-900 text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="py-1 px-4 ">
                    <div class="flex flex-wrap">
                        <template v-for="(link, key) in layanan.links">
                            <div v-if="link.url === null" :key="key"
                                class="mb-1 mr-1 px-4 py-3 text-gray-900 text-sm leading-4 border rounded"
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
    </AuthenticatedLayout>
</template>
