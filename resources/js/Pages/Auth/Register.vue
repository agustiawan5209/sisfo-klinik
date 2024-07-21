<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name:'',
    alamat:'',
    username:'',
    tgl_lahir:'',
    email:'',
    password:'',
    no_telpon:'',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <label for="firstname" class="text-sm">Nama Lengkap</label>
                <TextInput id="firstname" type="text" placeholder="nama lengkap" v-model="form.name"
                    class="w-full text-gray-900" />
                <InputError :message="form.errors.name" />
            </div>
            <div class="mt-4">
                <label for="no_telpon" class="text-sm">No. Telepon</label>
                <TextInput id="no_telpon" type="text" v-model="form.no_telpon" placeholder="No. telpon"
                    class="w-full text-gray-900" />
                <InputError :message="form.errors.no_telpon" />
            </div>
            <div class="mt-4">
                <label for="alamat" class="text-sm">Alamat</label>
                <TextInput id="alamat" type="text" v-model="form.alamat" placeholder="" class="w-full text-gray-900" />
                <InputError :message="form.errors.alamat" />
            </div>
            <div class="mt-4">
                <label for="tgl_lahir" class="text-sm">Tanggal Lahir</label>
                <TextInput id="tgl_lahir" type="date" v-model="form.tgl_lahir" placeholder=""
                    class="w-full text-gray-900" />
                <InputError :message="form.errors.tgl_lahir" />

            </div>
            <div class="mt-4">
                <label for="username" class="text-sm">username</label>
                <TextInput id="username" type="text" v-model="form.username" placeholder="@username"
                    class="w-full text-gray-900" />
                <InputError :message="form.errors.username" />

            </div>

            <div class="mt-4">
                <label for="email" class="text-sm">Email</label>
                <TextInput id="email" type="email" placeholder="" v-model="form.email" class="w-full text-gray-900" />
                <InputError :message="form.errors.email" />

            </div>

            <div class="mt-4">
                <label for="state" class="text-sm">Password</label>
                <TextInput id="state" type="text" placeholder="" v-model="form.password" class="w-full text-gray-900" />
                <InputError :message="form.errors.password" />

            </div>
            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
