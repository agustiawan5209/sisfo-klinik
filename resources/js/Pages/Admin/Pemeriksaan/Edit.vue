<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps, onMounted, inject } from 'vue';


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
    layanan: {
        type: Object,
        default:()=>({})
    },
    pendaftaran: {
        type: Object,
        default:()=>({})
    },
    pasien: {
        type: Object,
        default:()=>({})
    },
    pemeriksaan: {
        type: Object,
        default:()=>({})
    },
})
const Form = useForm({
    id_pasien:props.pemeriksaan.id_pasien,
    id_layanan:props.pemeriksaan.id_layanan,
    id_pendaftaran:props.pemeriksaan.id_pendaftaran,
    nama_pasien: props.pemeriksaan.nama_pasien,
    nama_layanan: props.pemeriksaan.nama_layanan,
    nama_petugas: props.pemeriksaan.nama_petugas,
    nama_dokter: props.pemeriksaan.nama_dokter,
    hasil_pemeriksaan: props.pemeriksaan.hasil_pemeriksaan,
    tgl_pemeriksaan: props.pemeriksaan.tgl_pemeriksaan,
})

const getPendaftaran = async function (event) {
    const id = event.target.value;
    console.log(id)
    axios.get(route('api.get.Pendaftaran', { id: id }), {
        params: {
            id: id,
        }
    })
        .then((response) => {
            const element = response.data;
            Form.id_pendaftaran = element.id;
            Form.id_layanan = element.id_layanan;
            Form.id_pasien = element.id_pasien;
            Form.nama_pasien = element.nama_pasien;
            Form.nama_layanan = element.nama_layanan;

        }).catch((err) => {
            console.log(err)
            const error = err.response;
            messageDisplay(error, "error")

        })
}


function submit() {
    Form.put(route('Pemeriksaan.update', {slug: props.pemeriksaan.id}), {
        onError: (err) => {
            console.log(err)
        }
    });
}


</script>

<template>

    <Head title="Pemeriksaan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Edit Pemeriksaan</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium text-xl">Edit Informasi Pemeriksaan Kesehatan Gigi Klinik Fahri Dent</p>
                        <p class="text-xs">Edit data</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="id_pendaftaran" class="text-sm">Nomor Antrian</label>
                                <select name="id_pendaftaran" id="id_pendaftaran"  @change="getPendaftaran($event)"
                                class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm w-full text-gray-900">
                                <option value="">---</option>
                                <option v-for="jab in pendaftaran" :value="jab.id">Nomor Antrian: {{ jab.nomor_antrian }}|| Tanggal: {{jab.tgl}}</option>
                            </select>

                                <InputError :message="Form.errors.id_layanan"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_layanan" class="text-sm">ID Layanan</label>
                                <TextInput id="nama_layanan" readonly type="text" placeholder="" v-model="Form.nama_layanan"  class="w-full text-gray-900"  />

                                <InputError :message="Form.errors.nama_layanan"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_pasien" class="text-sm">Nama Pasien</label>
                                <TextInput id="nama_petugas" readonly type="text" placeholder="nama Pemeriksaan" v-model="Form.nama_pasien"  class="w-full text-gray-900"  />

                                <InputError :message="Form.errors.nama_pasien"/>
                            </div>

                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_petugas" class="text-sm">Nama Petugas</label>
                                <TextInput id="nama_petugas" type="text" placeholder="nama Pemeriksaan" v-model="Form.nama_petugas"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.nama_petugas"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_dokter" class="text-sm">Nama Dokter</label>
                                <TextInput id="nama_dokter" type="text" placeholder="nama Pemeriksaan" v-model="Form.nama_dokter"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.nama_dokter"/>
                            </div>

                            <div class="col-span-full sm:col-span-3">
                                <label for="tgl_pemeriksaan" class="text-sm">Tanggal Pemeriksaan</label>
                                <TextInput id="tgl_pemeriksaan" type="date" placeholder="nama Pemeriksaan" v-model="Form.tgl_pemeriksaan"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.tgl_pemeriksaan"/>
                            </div>
                            <div class="col-span-full">
                                <label for="hasil_pemeriksaan" class="text-sm">Hasil Pemeriksaan</label>
                                <div class="bg-white w-full h-max">
                                    <quill-editor id="hasil_pemeriksaan" contentType="html" theme="snow"
                                v-model:content="Form.hasil_pemeriksaan" placeholder="@hasil_pemeriksaan"
                                class="w-full text-gray-900" />
                                </div>
                                <InputError :message="Form.errors.hasil_pemeriksaan" class="mt-10"/>
                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full text-center mt-32">Simpan</PrimaryButton>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
