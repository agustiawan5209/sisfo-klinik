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

        $org = User::factory(30)
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
            })
            ->has(Pasien::factory())
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
