<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituicaoRequest extends FormRequest
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
        return [
            'nome'   => 'required',
            'cnpj'   => 'required|unique:instituicoes,cnpj,'.$this->segment(2).',id',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nome.required'   => 'O campo Nome é obrigatório',
            'cnpj.required'   => 'O campo CNPJ é obrigatório',
            'cnpj.unique'     => 'Este CNPJ já está cadastrado',
            'status.required' => 'O campo Status é obrigatório'
        ];
    }
}
