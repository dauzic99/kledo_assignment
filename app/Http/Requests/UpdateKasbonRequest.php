<?php

namespace App\Http\Requests;

use App\Rules\approve_yet;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKasbonRequest extends FormRequest
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
            'id' => ['required', 'exists:kasbons,id', new approve_yet],
        ];
    }
}
