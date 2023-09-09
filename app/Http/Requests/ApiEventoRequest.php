<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ApiEventoRequest extends FormRequest
{
    public $now = null;

    public function __construct()
    {
        $this->now = Carbon::now();
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'anio' => [
                'required',
                sprintf('in:%s', $this->aniosValidos())
            ],
            'mes' => [
                'required',
                sprintf('in:%s', $this->mesesValidos())
            ],
        ];
    }

    public function messages()
    {
        return [
            'anio.required' => __('Selecciona el año'),
            'anio.in' => __('Selecciona un año válido'),
            'mes.required' => __('Selecciona el mes'),
            'mes.in' => __('Selecciona un mes válido'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'anio' => $this->route('anio') ?? null,
            'mes' => $this->route('mes') ?? null,
        ]);
    }

    public function aniosValidos()
    {
        $anios = range(
            ($this->now->year - 1),
            ($this->now->year + 1)
        );

        return implode(',', $anios);
    }

    public function mesesValidos()
    {
        $meses = array_map(function ($numero) {
            return str_pad($numero, 2, '0', STR_PAD_LEFT);
        }, range(1, 12));

        return implode(',', $meses);
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
