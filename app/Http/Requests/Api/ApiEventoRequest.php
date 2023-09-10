<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiEventoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'anio' => [
                'required',
                'date_format:Y',
            ],
            'mes' => [
                'nullable',
                'numeric',
                'between:1,12',
            ],
        ];
    }

    public function messages()
    {
        return [
            'anio.required' => __('El año es requerido'),
            'anio.date_format' => __('El año debe ser de 4 dígitos(####)'),
            'mes.numeric' => __('El mes debe ser númerico'),
            'mes.between' => __('El mes debe ser del 1 al 12'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'anio' => $this->route('anio') ?? null,
            'mes' => $this->route('mes') ?? null,
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 400,
                'data' => [],
                'message' => $validator->errors()->first(),
            ], 400)
        );
    }
}
