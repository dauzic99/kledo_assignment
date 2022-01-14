<?php

namespace App\Http\Requests;

use App\Rules\limit_kasbon;
use App\Rules\max_kasbon;
use App\Rules\year_working;
use Illuminate\Foundation\Http\FormRequest;

class StoreKasbonRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pegawai_id' => ['required', 'exists:pegawais,id', 'integer', new year_working, new max_kasbon],
            'total_kasbon' => ['required', 'integer', new limit_kasbon($this->pegawai_id)],
        ];
    }
}
