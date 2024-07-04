<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemeriksaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_layanan' => 'required|exists:layanans,id',
            'id_pasien' => 'required|exists:pasiens,id',
            'id_pendaftaran' => 'required|exists:daftar_layanans,id',
            'nama_petugas' => 'required|string',
            'nama_layanan' => 'required|string',
            'nama_pasien' => 'required|string',
            'hasil_pemeriksaan' => 'required|string',
            'tgl_pemeriksaan' => 'required|string',
        ];
    }
}
