<?php

namespace App\Http\Requests;

use App\Models\FamiliaMiembro;
use App\Models\Miembro;
use Illuminate\Foundation\Http\FormRequest;

class FamiliaMiembroSyncRequest extends FormRequest
{
    public $custom_rules = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->custom_rules;
    }

    public function messages()
    {
        return [
            'familia.required' => __('Selecciona el familiar'),
            'familia.exists' => __('Selecciona un familiar válido'),
            'parentesco.required' => __('Selecciona el parentesco'),
        ];
    }

    public function prepareForValidation()
    {
        $this->custom_rules = [
            'familia' => ['required', sprintf('exists:%s,%s', Miembro::class, 'id')],
            'parentesco' => ['required', sprintf('in:%s', implode(',', FamiliaMiembro::getParentescos()))],
        ];

        if( $this->isMethod('delete') )
            unset($this->custom_rules['parentesco']);
    }

    public function withValidator($validator)
    {
        if( $validator->fails()  )
            session()->flash('danger', $validator->errors()->first());
    }
}
