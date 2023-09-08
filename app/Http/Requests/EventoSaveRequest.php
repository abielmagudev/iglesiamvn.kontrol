<?php

namespace App\Http\Requests;

use App\Models\Evento;
use Illuminate\Foundation\Http\FormRequest;

class EventoSaveRequest extends FormRequest
{
    public $evento_id = null;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => ['required', sprintf('unique:%s,nombre,%s,id', Evento::class, $this->evento_id)],
            'descripcion' => ['nullable','string'],
            'fecha' => ['required', 'date'],
            'hora' => ['required','date_format:H:i'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => __('Escribe el nombre'),
            'nombre.unique' => __('Escribe un nombre diferente'),
            'descripcion.string' => __('Escribe una descripción válida'),
            'fecha.required' => __('Selecciona la fecha'),
            'fecha.date' => __('Selecciona una fecha válida'),
            'hora.required' => __('Selecciona la hora y minutos'),
            'hora.date_format' => __('Selecciona una hora válida, sin segundos ó segundos en 00'),
        ];
    }

    public function prepareForValidation()
    {
        // dd($this->all());
        $this->evento_id = $this->route('evento')->id ?? 0;
    }
}
