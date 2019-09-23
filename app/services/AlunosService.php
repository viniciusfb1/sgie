<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 2019-09-22
 * Time: 15:28
 */

namespace App\services;


use App\Http\Requests\AlunoInstituicaoCursoRequest;
use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Models\AlunoCurso;
use App\Models\Curso;
use App\Models\Instituicao;
use App\Models\InstituicaoAluno;
use Illuminate\Support\Facades\DB;

class AlunosService
{

    public function store(AlunoRequest $request)
    {
        DB::beginTransaction();
        try {

            $aluno = new Aluno();

            $aluno->nome = $request->nome;
            $aluno->cpf  = $request->cpf;
            $aluno->email  = $request->email;
            $aluno->data_nasc  = $request->data_nasc;
            $aluno->celular  = $request->celular;
            $aluno->cep  = $request->cep;
            $aluno->endereco  = $request->endereco;
            $aluno->numero  = $request->numero;
            $aluno->bairro  = $request->bairro;
            $aluno->cidade  = $request->cidade;
            $aluno->uf  = $request->uf;
            $aluno->status  = $request->status;
            $aluno->save();

            $instituicaoAluno = new InstituicaoAluno();
            $instituicaoAluno->instituicao_id = $request->instituicao;
            $instituicaoAluno->aluno_id = $aluno->id;
            $instituicaoAluno->save();

            $alunoCurso = new AlunoCurso();
            $alunoCurso->aluno_id = $aluno->id;
            $alunoCurso->curso_id = $request->curso;
            $alunoCurso->save();

            DB::commit();

            return ['status' => 200, 'aluno' => $aluno];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function update(AlunoRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $aluno = Aluno::findOrFail($id);

            $aluno->nome = $request->nome;
            $aluno->cpf  = $request->cpf;
            $aluno->email  = $request->email;
            $aluno->data_nasc  = $request->data_nasc;
            $aluno->celular  = $request->celular;
            $aluno->cep  = $request->cep;
            $aluno->endereco  = $request->endereco;
            $aluno->numero  = $request->numero;
            $aluno->bairro  = $request->bairro;
            $aluno->cidade  = $request->cidade;
            $aluno->uf  = $request->uf;
            $aluno->status  = $request->status;
            $aluno->save();

            DB::commit();

            return ['status' => 200, 'response' => $aluno];
        } catch (\Exception $e) {
            DB::rollBack();

            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function addCurso(AlunoInstituicaoCursoRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $instituicaoAluno                 = new InstituicaoAluno();
            $instituicaoAluno->instituicao_id = $request->instituicao;
            $instituicaoAluno->aluno_id       = $id;
            $instituicaoAluno->save();

            $alunoCurso = new AlunoCurso();
            $alunoCurso->aluno_id = $id;
            $alunoCurso->curso_id = $request->curso;
            $alunoCurso->save();

            $curso = Curso::findOrFail($alunoCurso->curso_id);
            $instituicao = Instituicao::findOrFail($instituicaoAluno->instituicao_id);

            DB::commit();

            return ['status' => 200, 'response' => ['instituicao' => ['id' => $instituicaoAluno->instituicao_id, 'nome' => $instituicao->nome], 'curso' => ['id' => $alunoCurso->curso_id, 'nome' => $curso->nome]]];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $alunoCurso = AlunoCurso::where('aluno_id', $id)->get();
            $alunoInstituicao = InstituicaoAluno::where('aluno_id', $id)->get();
            $aluno = Aluno::findOrFail($id);

            if(count($alunoCurso) > 0) {
                foreach($alunoCurso as $ac) {
                    $ac->delete();
                }
            }


            if(count($alunoInstituicao) > 0) {
                foreach ($alunoInstituicao as $ai) {
                    $ai->delete();
                }
            }

            if($aluno) {
                $aluno->delete();
            }

            DB::commit();

            return ['status' => 200, 'response' => 'Aluno deletado com sucesso'];
        } catch ( \Exception $e) {
            DB::rollBack();

            return ['status' => 400, 'response' => "Houve um erro ao deletar o aluno"];
        }
    }
}
