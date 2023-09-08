<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaSaveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha' => [],
            'nombre' => [],
            'medios_contacto' => [],
            'explicacion' => [],
            'respuestas' => [],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
