<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemeriksaanRequest extends FormRequest
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
            'id_pasien' => 'required',
            'id_pendaftaran' => 'required',
            'nama_petugas' => 'required|string',
            'nama_layanan' => 'required|string',
            'nama_pasien' => 'required|string',
            'nama_dokter' => 'required|string',
            'hasil_pemeriksaan' => 'required|string',
            'tgl_pemeriksaan' => 'required|string',
        ];
    }
}
