<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|unique:pegawais,nama|max:10',
            'tanggal_masuk' => 'required|date|before_or_equal:' . date('Y-m-d'),
            'total_gaji' => 'required|integer|min:4000000|max:10000000'
        ];
    }
}
