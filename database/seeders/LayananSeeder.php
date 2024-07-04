<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Layanan::insert([
            [
                'nama_layanan' => 'pemasangan gigi agrilik',
                'keterangan' => "pembuatan gigi serta pemasangan gigi dapat terbuat dari bahan agrilik",
                'harga'=> 'Rp.250.000',
            ],
            [
                'nama_layanan' => 'pemasangan gigi valplast',
                'keterangan' => "pembuatan gigi serta pemasangan gigi dapat terbuat dari bahan agrilik",
                'harga'=> 'Rp.500.000',
            ],
            [
                'nama_layanan' => ' scalling gigi',
                'keterangan' => "Scalling Gigi",
                'harga'=> 'Rp.150.000-Rp.250.000',
            ],
            [
                'nama_layanan' => 'Pemasangan Behel',
                'keterangan' => "Pemasangan Behel",
                'harga'=> 'Rp.1.500.000-Rp.4.000.000',
            ],
            [
                'nama_layanan' => 'Konsul',
                'keterangan' => "Konsuling Untuk Gigi",
                'harga'=> 'Rp.50.000',
            ],
        ]);
    }
}
