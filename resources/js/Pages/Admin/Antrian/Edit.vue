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
})
const Form = useForm({
    slug: props.layanan.id,
    nama_layanan:props.layanan.nama_layanan,
    keterangan:props.layanan.keterangan,
    harga:props.layanan.harga,
})

function submit() {
    Form.put(route('Layanan.update'), {
        onError: (err) => {
            console.log(err)
        }
    });
}


</script>

<template>

    <Head title="Antrian" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Antrian</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Informasi Layanan Kesehatan</p>
                        <p class="text-xs">Tambahkan data Layanan Kesehatan</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_layanan" class="text-sm">Nama Layanan</label>
                                <TextInput id="nama_layanan" type="text" placeholder="nama Layanan" v-model="Form.nama_layanan"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.nama_layanan"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="nama_layanan" class="text-sm">Keterangan</label>
                                <TextInput id="nama_layanan" type="text" placeholder="Keterangan" v-model="Form.keterangan"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.keterangan"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="harga" class="text-sm">Harga</label>
                                <TextInput id="harga" type="text" placeholder="Harga" v-model="Form.harga"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.harga"/>
                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full text-center">Simpan</PrimaryButton>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
