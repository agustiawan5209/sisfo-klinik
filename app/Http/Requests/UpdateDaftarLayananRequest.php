<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDaftarLayananRequest extends FormRequest
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
            'id_pasien' => 'required|exists:pasiens,id',
            'nama_pasien' => 'required|string',
            'id_layanan' => 'required|exists:layanans,id',
            'nama_layanan' => 'required|string',
            'nomor_antrian' => 'required|string',
            'tgl' => 'required|date',
            'status' => 'required|in_array:0,1,2',
        ];
    }
}
