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
    pasien: {
        type: Object,
        default:()=>({})
    },
})
const Form = useForm({
    slug:props.pasien.id,
    name:props.pasien.user.name,
    alamat:props.pasien.alamat,
    username:props.pasien.user.username,
    tgl_lahir:props.pasien.tgl_lahir,
    email:props.pasien.user.email,
    password:props.pasien.user.password,
    no_telpon:props.pasien.no_telpon,
})

function submit() {
    Form.put(route('Pasien.update'), {
        onError: (err) => {
            console.log(err)
        }
    });
}


</script>

<template>

    <Head title="Pasien" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form Tambah Pasien</h2>
        </template>

        <div class="py-4 relative box-content">
            <section class="p-6 bg-gray-100 text-gray-900">
                <form @submit.prevent="submit()" novalidate="" action="" class="container flex flex-col mx-auto space-y-12">
                    <div class="space-y-2 col-span-full lg:col-span-1">
                        <p class="font-medium">Data Informasi Pasien</p>
                        <p class="text-xs">Tambahkan data Pasien</p>
                    </div>
                    <fieldset class="grid grid-cols-3 gap-6 p-6 rounded-md shadow-sm bg-gray-50">
                        <div class="grid grid-cols-6 gap-4 col-span-full lg:col-span-3">
                            <div class="col-span-full sm:col-span-3">
                                <label for="firstname" class="text-sm">Nama Lengkap</label>
                                <TextInput id="firstname" type="text" placeholder="nama lengkap" v-model="Form.name"  class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.name"/>
                            </div>
                            <div class="col-span-full sm:col-span-3">
                                <label for="no_telpon" class="text-sm">No. Telepon</label>
                                <TextInput id="no_telpon" type="text" v-model="Form.no_telpon" placeholder="No. telpon" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.no_telpon"/>

                            </div>
                            <div class="col-span-full">
                                <label for="alamat" class="text-sm">Alamat</label>
                                <TextInput id="alamat" type="text" v-model="Form.alamat" placeholder="" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.alamat"/>

                            </div>
                            <div class="col-span-full">
                                <label for="tgl_lahir" class="text-sm">Tanggal Lahir</label>
                                <TextInput id="tgl_lahir" type="date" v-model="Form.tgl_lahir" placeholder="" class="w-full text-gray-900"  />
                                <InputError :message="Form.errors.tgl_lahir"/>

                            </div>
                        </div>
                        <PrimaryButton type="submit" class="col-span-full text-center">Simpan</PrimaryButton>
                    </fieldset>
                </form>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
