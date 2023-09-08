<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutenticarRequest extends FormRequest
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
            'usuario' => [
                'required',
                'string',
                'min:6'
            ],
            'contrasena' => [
                'required',
                'string',
                'min:6'
            ],
        ];
    }

    public function passedValidation()
    {
        $this->merge([
            'name' => $this->usuario,
            'password' => $this->contrasena,
        ]);
    }
}
