<?php

namespace Database\Seeders;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Admin']);
        $orangtua = Role::create(['name' => 'Pasien']);
        $klinik = Role::create(['name' => 'Klinik']);

        $user = User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($role);
        $user->givePermissionTo([
            'add pasien',
            'edit pasien',
            'delete pasien',
            'show pasien',
            'reset pasien',

            'add layanan',
            'edit layanan',
            'delete layanan',
            'show layanan',

            'add pemeriksaan',
            'edit pemeriksaan',
            'delete pemeriksaan',
            'show pemeriksaan',

        ]);

        $org = User::factory(10)
            ->afterCreating(function (User $user) {
                $role = Role::findByName('Pasien'); // Replace 'user' with your actual role name
                if ($role) {
                    $user->assignRole($role); // Assign 'user' role to the user
                }
                $user->givePermissionTo([
                    'add antrian',
                    'edit antrian',
                    'delete antrian',
                    'show antrian',
                ]);
                $lastId = $user->id;

                // Membuat kode transaksi dengan format yang diinginkan
                $id_pasien = 'LN-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
                $pasien = Pasien::create([
                    'id_pasien' => $id_pasien,
                    'user_id' => $user->id,
                    'alamat' => fake()->address(),
                    'no_telpon' => fake()->phoneNumber(),
                    'tgl_lahir' => fake()->dateTimeBetween('-3 years', '3 years')->format('Y-m-d'),
                ]);
            })
            ->create();



        $user_klinik = User::factory()->create([
            'name' => 'klinik',
            'username' => 'klinik',
            'email' => 'klinik@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user_klinik->assignRole($klinik);
    }
}
