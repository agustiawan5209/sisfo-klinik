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
            'id_layanan' => 'required|exists:pemeriksaans,id',
            'id_pasien' => 'required|exists:pemeriksaans,id',
            'nama_petugas' => 'required|string',
            'hasil_pemeriksaan' => 'required|string',
            'tgl_pemeriksaan' => 'required|string',
        ];
    }
}
