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
            'tgl_pemeriksaan',
            'nama_layanan',
            // 'id_pasien',
            'nama_pasien',
            'nama_petugas',
            'nama_dokter',
            'hasil_pemeriksaan',
        ];
        return Inertia::render('Admin/Laporan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'status', 'id_pendaftaran', 'id_pasien', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => Pemeriksaan::whereBetween('tgl_pemeriksaan', [Request::input('start_date'), Request::input('end_date')])
            ->orderBy('tgl_pemeriksaan', 'desc')
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
        $data = Pemeriksaan::whereBetween('tgl_pemeriksaan', Request::only('start_date', 'end_date'))
        ->orderBy('tgl_pemeriksaan', 'desc')
            ->with(['pasien'])
            ->get();



        // Load view untuk PDF dan pass data pemeriksaan
        $pdf = PDF::loadView('pdf.pemeriksaan', compact('data'))->setPaper('a4', 'landscape');

        // Unduh PDF
        return $pdf->download('pemeriksaan.pdf');
    }
}
