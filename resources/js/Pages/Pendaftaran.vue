<script setup>
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
    jampelayanan: {
        type: Object,
        default: () => ({}),
        required: true,
    },
    layanan: {
        type: Object,
        default: () => ({}),
        required: true,
    },
    pemeriksaan: {
        type: Object,
        default: () => ({}),
        required: true,
    },
})


const showModal = ref(false);
const btnModal = ref(false);

const formLayanan = useForm({
    id_pasien: '',
    id_layanan: '',
    nama_layanan: '',
    jam_pelayanan: '',
    tgl: '',
})

const getLayanan = async function (id, param) {
    axios.get(route('api.get.Layanan', { id: id }), {
        params: param
    })
        .then((response) => {
            const element = response.data;
            var layananid = element.nama_layanan + '|' + element.id_layanan;
            if (element.id_layanan == null) {
                layananid = element.nama_layanan
            }
            formLayanan.id_layanan = element.id;
            formLayanan.nama_layanan = layananid;
            closeModal();
        }).catch((err) => {
            console.log(err)
            const error = err.response.data;
            messageDisplay(error, "error")

        })
}

const buttonProses = ref(true);
// Cek data apakah antrian sudah tersedia
const cekJadwal = async function (id, param) {
    axios.get(route('api.cek.Jadwal', param))
        .then((response) => {
            // data respon merupakan angka
            let countres = response.data;

            if (countres > 0) {
                messageDisplay('Maaf Jadwal Antrian Sudah Ada untuk Jam =' + param.jam_pemeriksaan, 'error');
                buttonProses.value = true;
            } else {
                formLayanan.tgl = param.tgl;
                formLayanan.jam_pelayanan = param.jam_pemeriksaan;
                buttonProses.value = false;
            }

        }).catch((err) => {
            console.log(err)
            const error = err.response.data;
            messageDisplay(error, "error")

        })
}

const tglDaftar = ref('');
const jamPemeriksaan = ref('')


watch(tglDaftar, async (value) => {
    if (value && jamPemeriksaan.value) {
        await cekJadwal(formLayanan.id_layanan, {
            jam_pemeriksaan: jamPemeriksaan.value,
            tgl: value,
        })
    }
})
watch(jamPemeriksaan, async (value) => {
    if (value && tglDaftar.value) {
        await cekJadwal(formLayanan.id_layanan, {
            tgl: tglDaftar.value,
            jam_pemeriksaan: value,
        })
    }
})
function submit() {
    formLayanan.post(route('User.Layanan.store'), {
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

const modalLayanan = ref(false);
const modalPemeriksaan = ref(false)

const showModalLayanan = () => {
    modalLayanan.value = true;
}
const closeModal = () => {
    modalLayanan.value = false;
}

function formatTanggal(date) {
  return date.toLocaleDateString("id-ID", {
    year: "numeric",
    month: "long",
    day: "numeric",
    timeZone: "Asia/Makassar"
  });
}

// Mendapatkan tanggal hari ini
const hariIni = new Date();
const hariIniMakassar = new Date(hariIni.toLocaleString("en-US", { timeZone: "Asia/Makassar" }));

// Mendapatkan tanggal besok
const besok = new Date(hariIniMakassar);
besok.setDate(hariIniMakassar.getDate() + 1);

// Menampilkan tanggal hari ini dan besok
console.log("Hari ini:", formatTanggal(hariIniMakassar));
console.log("Besok:", formatTanggal(besok));
</script>

<template>
    <!-- Form -->
    <Modal :show="showModal" maxWidth="2xl">
        <div class="w-full flex flex-col justify-center items-center py-4">
            <div class="text-gray-700 text-center">
                <h3 class="text-xl md:text-2xl">Form Buat Antrian</h3>
                <p class="text-justify text-sm">Isi Form untuk Membuat Nomor Antrian <br>
                    Isi Tanggal Sesuai Dengan Tanggal Anda Ingin Data Ke Klinik</p>
            </div>
            <form action="" @submit.prevent="submit" class="w-full border p-4 rounded-lg my-10">
                <div class="mt-2">
                    <inputLabel value="Pilih Layanan" />
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" v-if="pemeriksaan != null" @click="getLayanan(pemeriksaan.id)"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            Pemeriksaan
                        </button>
                        <button type="button" @click="showModalLayanan"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            Pilih Layanan
                        </button>
                    </div>
                </div>
                <div class="mt-2">
                    <inputLabel for="layanan" value="Layanan Yang Dipilih" />
                    <TextInput type="text" class="w-full " readonly v-model="formLayanan.nama_layanan" />
                </div>
                <div class="mt-2">
                    <inputLabel for="list-radio" value="Hari Kedatangan" />

                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input v-model="tglDaftar" id="radio-hari-ini" type="radio" value="hari ini"
                                    name="list-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="radio-hari-ini"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hari
                                    Ini |{{ formatTanggal(hariIniMakassar) }} </label>
                            </div>
                        </li>
                        <li class="w-full dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input v-model="tglDaftar" id="radio-besok" type="radio" value="besok" name="list-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="radio-besok"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Besok |{{ formatTanggal(besok) }} </label>
                            </div>
                        </li>
                    </ul>

                </div>

                <div class="mt-2">
                    <inputLabel for="jam_pelayanan" value="Jam Pelayanan" />

                    <ul
                        class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li v-for="item in jampelayanan"
                            class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input v-model="jamPemeriksaan" :id="'jam_pelayanan' + item.id" type="radio"
                                    :value="item.jam" :name="'jam_pelayanan'"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label :for="'jam_pelayanan' + item.id"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{
                                        item.jam }}</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="mt-2 flex justify-center">
                    <PrimaryButton type="submit" :disabled="buttonProses"
                        class="bg-green-500 hover:bg-green-700 disabled:bg-opacity-20">Buat Antrian
                    </PrimaryButton>
                </div>

            </form>
        </div>
    </Modal>

    <!-- Daftar Layanan -->
    <Modal :show="modalLayanan">
        <div class="col-span-1 sm:col-span-8 md:col-span-7 bg-white p-2">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left uppercase border-b border-gray-700  text-gray-800">
                            <th class="px-4 py-3">ID Layanan</th>
                            <th class="px-4 py-3">Pilih Layanan Layanan</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class=" divide-y divide-gray-700" v-if="layanan.length">
                        <tr class="text-gray-800" v-for="(item, index) in layanan">
                            <td class="px-4 py-3 text-sm">
                                {{ item.id_layanan }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ item.nama_layanan }}
                                <p class="text-xs">{{ item.keterangan }}</p>
                                <br>
                                <span
                                    class="px-2 py-1 font-semibold leading-tight rounded-full whitespace-nowrap bg-green-700 text-green-100">
                                    {{ item.harga }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <PrimaryButton type="button" @click="getLayanan(item.id)" class="bg-green-400">
                                    Buat Antrian
                                </PrimaryButton>
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
        </div>
    </Modal>
    <!-- start hero -->
    <div class="bg-gray-100">
        <section class="cover bg-blue-teal-gradient relative bg-blue-600 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 overflow-hidden py-20 flex
  items-center min-h-screen">
            <div class="h-full w-full absolute top-0 left-0 z-0">
                <img src="images/cover-bg.jpg" alt="" class="w-full h-full object-cover opacity-20">
            </div>


            <!-- Layanan -->
            <div class="lg:w-3/4 xl:w-2/4 relative z-10 h-100 lg:mt-16">
                <div>
                    <h1 class="text-white text-xl md:text-2xl xl:text-5xl font-bold leading-tight">SISTEM PENGELOLAAN
                        DATA
                        PEMERIKSAAN GIGI</h1>
                    <p class="text-blue-100 text-xl md:text-2xl leading-snug mt-4">
                        KLINIK FAHRI DENT KOTA MAKASSAR</p>
                    <a @click="showModal = true" href="#"
                        class="px-8 py-4 bg-teal-500 text-white rounded inline-block mt-8 font-semibold">
                        Daftar Untuk Pemeriksaan
                    </a>
                </div>
            </div>

        </section>
    </div>
    <!-- end hero -->
</template>
