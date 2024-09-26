<script setup>
import UserLayout from '@/Layouts/UserLayout.vue';
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
    id_pasien: '',
    id_layanan: '',
    nama_layanan: '',
    tgl: '',
})

const getLayanan = async function (id) {
    axios.get(route('api.get.Layanan', { id: id }), {
        params: {
            id: id,
        }
    })
        .then((response) => {
            const element = response.data;
            formLayanan.id_layanan = element.id;
            formLayanan.nama_layanan = element.nama_layanan;
            showModal.value = true;

        }).catch((err) => {
            console.log(err)
            const error = err.response.data;
            messageDisplay(error, "error")

        })
}

function submit(){
    formLayanan.post(route('User.Layanan.store'),{
        preserveState: false,
        onError: (err)=>{
            var ul = "";
            for(const key in err){
                ul+= err[key]+ '\n';

            }
            // err.forEach((element,key)=>{
            // })
            messageDisplay(ul, 'error');
        },
        onFinish: ()=>{
            showModal.value = false;
        }

    })
}
</script>

<template>

    <Head title="Layanan" />

    <UserLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Layanan</h2>
        </template>


        <Modal :show="showModal" maxWidth="md">
            <div class="w-full flex flex-col justify-center items-center py-4">
                <div class="text-gray-700 text-center">
                    <h3 class="text-xl md:text-2xl">Form Buat Antrian</h3>
                    <p class="text-justify text-sm">Isi Form untuk Membuat Nomor Antrian <br>
                    Isi Tanggal Sesuai Dengan Tanggal Anda Ingin Data Ke Klinik</p>
                </div>
                <form action="" @submit.prevent="submit" class="w-full md:w-[70%] border p-4 rounded-lg my-10">
                    <div class="mt-2">
                        <inputLabel value="Nama Layanan" />
                        <TextInput class="w-full" type="text" v-model="formLayanan.nama_layanan"/>
                    </div>
                    <div class="mt-2">
                        <inputLabel value="Tanggal Kedatangan" />
                        <TextInput class="w-full" type="date" v-model="formLayanan.tgl"/>
                    </div>
                    <div class="mt-2 flex justify-center">
                        <PrimaryButton type="submit" class="bg-green-500 hover:bg-green-700">Buat Antrian</PrimaryButton>
                    </div>

                </form>
            </div>
        </Modal>
        <div class="py-4 relative box-content">
            <div class="w-full overflow-hidden rounded-lg shadow-xs divide-y divide-gray-700 bg-gray-800">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left uppercase border-b border-gray-700  text-gray-100 bg-gray-800">
                                <th class="px-4 py-3">No</th>
                                <th class="px-4 py-3">No. Antrian</th>
                                <th class="px-4 py-3">Nama Layanan | ID layanan</th>
                                <th class="px-4 py-3">Jam Pemeriksaan</th>
                                <th class="px-4 py-3">Status Layanan</th>
                                <th class="px-4 py-3">tgl</th>
                                    <th class="px-4 py-3">Cetak</th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y divide-gray-700 bg-gray-800" v-if="layanan.data.length">
                            <tr class="text-gray-100" v-for="(item, index) in layanan.data">
                                <td class="px-4 py-3">
                                    {{ (layanan.current_page - 1) * layanan.per_page + index + 1 }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.nomor_antrian }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.nama_layanan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.jam_pemeriksaan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.status_layanan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ item.tgl }}
                                </td>
                                <!-- <td class="px-4 py-3 text-xs">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full bg-green-700 text-green-100">
                                        {{ item.harga }}
                                    </span>
                                </td> -->
                                <td class="px-4 py-3 text-sm">
                                    <Link :href="route('User.Antrian.cetak', {id: item.id})">
                                        <PrimaryButton type="button"  class="bg-green-400">
                                            Cetak Antrian
                                        </PrimaryButton>
                                    </Link>
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
