<?php

namespace Database\Seeders;

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

    }
}
