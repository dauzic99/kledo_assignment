<?php

namespace App\Http\Requests;

use App\Rules\approve_yet;
use App\Rules\month_now;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMasalKasbonRequest extends FormRequest
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
            'id' => ['required', 'array'],
            'id.*' => ['required', 'distinct', 'exists:kasbons,id', new approve_yet, new month_now],
        ];
    }
}
