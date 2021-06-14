<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteFormRequest extends FormRequest
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
        $isCreate = $this->method() === 'POST';

        return [
            'ativo' => 'sometimes|boolean',
            'nome' => ($isCreate ? 'required' : 'sometimes').'|string|min:2|max:255',
            'senha' => ($isCreate ? 'required' : 'sometimes').'|min:8|max:255|regex:/^(?=.*[A-Z])(?=.*[0-9]+)(?=.*[a-z])([A-Za-z0-9$@$!%*#?&]){8,}$/',
            'email' => [
                ($isCreate ? 'required' : 'sometimes'),'email','max:255',
                (!$isCreate ? Rule::unique('clientes','email')->ignore($this->cliente->id) : 'unique:clientes,email')
            ],
            'telefone' => [($isCreate ? 'required' : 'sometimes'),'regex:/^(\(\d{2}\)\s?)(\d{4,5}\-\d{4})|(\(\d{2}\)\s?)(\d{8,9})$/'],
            'estado' => ($isCreate ? 'required' : 'sometimes').'|in:'.join(',', array_keys(__('estados'))),
            'cidade' => 'sometimes|string|min:2|max:255',
            'data_nascimento' => 'sometimes|date_format:Y-m-d|after_or_equal:1890-01-01',
            'imagem' => 'sometimes|file|image|dimensions:min_width=100,min_height=200|max:2048',

            'planos' => 'sometimes|array|distinct',
            'planos.*' => ['numeric','integer', Rule::exists('planos','id')->where('ativo', true)],
        ];
    }
}
