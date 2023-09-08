<?php

namespace App\Http\Requests;

use App\Models\Ministerio;
use Illuminate\Foundation\Http\FormRequest;

class MinisterioSaveRequest extends FormRequest
{
    public $ministerio_id = null;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => ['required', sprintf('unique:%s,nombre,%s,id', Ministerio::class, $this->ministerio_id)],
            'descripcion' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => __('Escribe el nombre'),
            'nombre.unique' => __('Escribe un nombre diferente'),
            'descripcion.string' => __('Escribe una descripción válida'),
        ];
    }

    public function prepareForValidation()
    {
        $this->ministerio_id = $this->ministerio->id ?? 0;
    }
}
