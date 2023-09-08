<?php

namespace App\Http\Requests;

use App\Models\Miembro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MiembroSaveRequest extends FormRequest
{
    public $claves_generos_biologicos_imploded;

    public $estados_civiles_imploded;

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
            'activo' => ['required', 'boolean'],
            'fecha_registro' => ['required', 'date'],
            'nombres' => ['required', 'string'],
            'apellidos' => ['required', 'string'],
            'genero' => ['required', sprintf('in:%s', $this->claves_generos_biologicos_imploded)],
            'fecha_nacimiento' => ['nullable', 'date'],
            'lugar_nacimiento' => ['nullable', 'string'],
            'estado_civil' => ['nullable', sprintf('in:%s', $this->estados_civiles_imploded)],
            'domicilio_miembro' => ['nullable', sprintf('exists:%s,%s', Miembro::class, 'id')],
            'direccion' => ['nullable', 'string'],
            'localidad' => ['nullable', 'string'],
            'numero_movil' => ['nullable', 'string'], 
            'numero_telefono' => ['nullable', 'string'], 
            'correo_electronico' => ['nullable', 'email'], 
            'web' => ['nullable', 'string'], 
            'emergencias' => ['nullable', 'string'],
            'ocupaciones' => ['nullable', 'string'],
            'notas' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'activo.required' => __('Selecciona una opción de activo'),
            'activo.boolean' => __('Selecciona una opción válida de activo'),
            'fecha_registro.required' => __('Selecciona una fecha de registro'),
            'fecha_registro.date' => __('Selecciona una fecha válida de registro'),
            'nombres.required' => __('Escribe el nombres(s)'),
            'nombres.string' => __('Escribe un nombre(s) válido'),
            'apellidos.required' => __('Escribel el apellido(s)'),
            'apellidos.string' => __('Escribe un apelllido(s) válido'),
            'genero.required' => __('Selecciona el género'),
            'genero.in' => __('Selecciona un género válido'),
            'fecha_nacimiento.date' => __('Selecciona una fecha de nacimiento válida'),
            'lugar_nacimiento.string' => __('Escribe un lugar de nacimiento válido'),
            'estado_civil.in' => __('Selecciona un estado civil válido'),
            'domicilio_miembro.exists' => __('Escribe o selecciona un miembro válido'),
            'direccion.string' => __('Escribe una dirección de domicilio válida'),
            'localidad.string' => __('Escribe una localidad de domicilio válida'),
            'numero_movil.string' => __('Escribe un número de móvil o celular válido'), 
            'numero_telefono.string' => __('Escribe un número de teléfono válido'), 
            'correo_electronico.email' => __('Escribe un correo electrónico válido'), 
            'web.string' => __('Escribe redes sociales o sitios web válidos'), 
            'emergencias.string' => __('Escribe información de emergencias válida'),
            'ocupaciones.string' => __('Escribe información de ocupaciones válida'),
            'notas' => ['nullable'],
        ];
    }

    public function prepareForValidation()
    {
        $this->claves_generos_biologicos_imploded = implode(',', Miembro::getClavesGenerosBiologicos());
        $this->estados_civiles_imploded = implode(',', Miembro::getEstadosCiviles());
    }

    public function validated()
    {
        $nombres_capitalized = Str::title($this->input('nombres'));
        $apellidos_capitalized = Str::title($this->input('apellidos'));

        return array_merge(parent::validated(), [
            'nombres' => $nombres_capitalized,
            'apellidos' => $apellidos_capitalized,
            'nombres_apellidos' => sprintf('%s %s', $nombres_capitalized, $apellidos_capitalized),
            'domicilio_miembro_id' => $this->get('domicilio_miembro'),
            'clave_genero_biologico' => $this->input('genero'),
        ]);
    }
}
