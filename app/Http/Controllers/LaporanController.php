<?php

namespace App\Http\Controllers;

use App\Models\DaftarLayanan;
use App\Models\Pemeriksaan;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tableName = 'pemeriksaans'; // Ganti dengan nama tabel yang Anda inginkan
        // $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns = [
            // 'id_layanan',
            // 'id_pendaftaran',
            'nama_layanan',
            // 'id_pasien',
            'nama_pasien',
            'nama_petugas',
            'nama_dokter',
            'hasil_pemeriksaan',
            'tgl_pemeriksaan',
        ];
        return Inertia::render('Admin/Laporan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'status', 'id_pendaftaran', 'id_pasien', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => Pemeriksaan::whereBetween('created_at', [Request::input('start_date'), Request::input('end_date')])
                ->paginate(10),
            'can' => [
                'add' => false,
                'edit' => false,
                'show' => false,
                'delete' => false,
                'reset_password' => false,
            ],
            'datelaporan' => Request::only('start_date', 'end_date'),
        ]);
    }

    public function cetakPDF()
    {
        // Ambil data pemeriksaan berdasarkan id
        $data = Pemeriksaan::whereBetween('created_at', Request::only('start_date', 'end_date'))
            ->with(['pasien'])
            ->get();



        // Load view untuk PDF dan pass data pemeriksaan
        $pdf = PDF::loadView('pdf.pemeriksaan', compact('data'));

        // Unduh PDF
        return $pdf->download('pemeriksaan.pdf');
    }
}
