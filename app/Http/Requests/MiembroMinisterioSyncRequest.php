<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MiembroMinisterioSyncRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'miembro' => ['required'],
            'funciones' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'miembro.required' => __('Selecciona el miembro'),
            'miembro.exists' => __('Selecciona un miembro válido'),
            'funciones.string' => __('Escribe una descripción de funciones válidos'),
        ];
    }
}
