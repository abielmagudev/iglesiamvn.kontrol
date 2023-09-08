<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class AutenticadoSaveRequest extends FormRequest
{
    public $usuario_id;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->withRulesPassword([
            'name' => [
                'bail',
                'required',
                'string',
                'regex:/^[a-zA-Z0-9_\.]+$/',
                'min:6',
                'max:255',
                sprintf('unique:%s,name,%s,id', User::class, auth()->user()->id),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,name,%s,id', User::class, auth()->user()->id),
            ]
        ]);
    }

    public function withRulesPassword(array $rules_base)
    {
        if( $this->isMethod('post') )
        {
            $rules_password = [
                'password' => [
                    'bail',
                    'required',
                    'min:6',
                    'confirmed',
                    'same:password_confirmation',
                ], 
                'password_confirmation' => [
                    'bail',
                    'required',
                    'same:password',
                ]
            ];
        }
        else
        {
            $rules_password = [
                'password' => [
                    'bail',
                    'nullable',
                    'min:6',
                    'confirmed',
                    'same:password_confirmation',
                ], 
                'password_confirmation' => [
                    'bail',
                    'required_with:password',
                    'same:password',
                ]
            ];
        }

        return array_merge($rules_base, $rules_password);
    }

    public function messages()
    {
        return [
            'name.required' => __('Escribe el nombre'),
            'name.string' => __('Escribe un nombre válido'),
            'name.regex' => __('Escribe un nombre con letras, números, punto(.) y guíon bajo (_)'),
            'name.min' => __('El nombre debe tener mínimo 6 caractéres'),
            'name.max' => __('El nombre debe tener máximo 255 caractéres'),
            'name.unique' => __('Escribe un nombre diferente'),
            'email.required' => __('Escribe el correo electrónico'),
            'email.email' => __('Escribe un correo electrónico válido'),
            'email.unique' => __('Escribe un correo electrónico diferente'),
            'password.required' => __('Escribe la contraseña'),
            'password.min' => 'La contraseña debe tener mínimo 6 caractéres',
            'password.confirmed' => 'La confirmación de la contraseña es requerida',
            'password.same' => 'La contraseña debe coincidir con la confirmación',
            'password_confirmation.required' => 'Escribe la confirmación de la contraseña',
            'password_confirmation.required_with' => 'Escribe la confirmación de la contraseña escrita',
            'password_confirmation.same' => 'La confirmación de la contraseña debe coincidir con la contraseña',
        ];
    }

    public function validated()
    {
        $validated = collect(parent::validated());

        if(! is_string($validated->get('password')) )
            return $validated->only(['email', 'name'])->toArray();

        return $validated->only(['email', 'name', 'password'])->toArray();
    }
}
