<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pasien Permission
        Permission::create(['name' => 'add pasien']);
        Permission::create(['name' => 'edit pasien']);
        Permission::create(['name' => 'delete pasien']);
        Permission::create(['name' => 'show pasien']);
        Permission::create(['name' => 'reset pasien']);

        // Antrian Permission
        Permission::create(['name' => 'add antrian']);
        Permission::create(['name' => 'edit antrian']);
        Permission::create(['name' => 'delete antrian']);
        Permission::create(['name' => 'show antrian']);

    }
}
