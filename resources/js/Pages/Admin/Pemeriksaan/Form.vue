<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps } from 'vue';

const props = defineProps({
    layanan: {
        type: Object,
        default:()=>({})
    },
    pasien: {
        type: Object,
        default:()=>({})
    },
})
const Form = useForm({
    id_pasien:'',
    id_layanan:'',
    nama_pasien: '',
    nama_layanan: '',
    nama_petugas: '',
    hasil_pemeriksaan: '',
    tgl_pemeriksaan: '',
})

function submit() {
    Form.post(route('Pemeriksaan.store'), {
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Pemeriksaan</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Informasi Pemeriksaan Kesehatan</p>
                        <p class="text-xs">Tambahkan data Pemeriksaan Kesehatan</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="id_layanan" class="text-sm">ID Layanan</label>
                                <select name="id_layanan" id="id_layanan"  v-model="Form.id_layanan"
                                    class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm w-full text-gray-900">
                                    <option value="">---</option>
                                    <option v-for="jab in layanan" :value="jab.id">{{ jab.nama_layanan }}</option>
                                </select>
                                <InputError :message="Form.errors.id_layanan"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="id_pasien" class="text-sm">Nama Pasien</label>
                                <select name="id_pasien" id="id_pasien"  v-model="Form.id_pasien"
                                    class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm w-full text-gray-900">
                                    <option value="">---</option>
                                    <option v-for="jab in pasien" :value="jab.id">{{ jab.user.name }}</option>
                                </select>
                                <InputError :message="Form.errors.id_pasien"/>
                            </div>

                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_petugas" class="text-sm">Nama Petugas</label>
                                <TextInput id="nama_petugas" type="text" placeholder="nama Pemeriksaan" v-model="Form.nama_petugas"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.nama_petugas"/>
                            </div>

                            <div class="col-span-full sm:col-span-3">
                                <label for="tgl_pemeriksaan" class="text-sm">Tanggal Pemeriksaan</label>
                                <TextInput id="tgl_pemeriksaan" type="date" placeholder="nama Pemeriksaan" v-model="Form.tgl_pemeriksaan"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.tgl_pemeriksaan"/>
                            </div>
                            <div class="col-span-full">
                                <label for="hasil_pemeriksaan" class="text-sm">Hasil Pemeriksaan</label>
                                <quill-editor id="hasil_pemeriksaan" contentType="html" theme="snow"
                                v-model:content="Form.hasil_pemeriksaan" placeholder="@hasil_pemeriksaan"
                                class="w-full text-gray-900" />
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
