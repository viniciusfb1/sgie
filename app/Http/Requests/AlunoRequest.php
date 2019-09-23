<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlunoRequest extends FormRequest
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
            'nome' => 'required',
            'email' => 'required|email|unique:alunos,email,'.$this->segment(2).',id',
            'cpf' => 'required|unique:alunos,cpf,'.$this->segment(2).',id',
            'data_nasc' => 'required',
            'celular' => 'required',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'status' => 'required',
            'instituicao' => 'required|sometimes',
            'curso' => 'required|sometimes'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'Preencha um email válido',
            'email.unique' => 'Este email já está cadastrado no sistema',
            'cpf.required' => 'O campo cpf é obrigatório',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema',
            'data_nasc.required' => 'O campo data de nascimento é obrigatório',
            'celular.required' => 'O campo celular é obrigatório',
            'cep.required' => 'O campo cep é obrigatório',
            'endereco.required' => 'O campo endereco é obrigatório',
            'numero.required' => 'O campo número é obrigatório',
            'bairro.required' => 'O campo bairro é obrigatório',
            'cidade.required' => 'O campo cidade é obrigatório',
            'uf.required' => 'O campo estado é obrigatório',
            'status.required' => 'O campo status é obrigatório',
            'instituicao.required' => 'O campo estado é obrigatório',
            'curso.required' => 'O campo estado é obrigatório',
        ];
    }
}
