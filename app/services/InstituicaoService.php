<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 2019-09-21
 * Time: 15:05
 */

namespace App\services;

use App\Http\Requests\InstituicaoCursoRequest;
use App\Http\Requests\InstituicaoRequest;
use App\Models\Curso;
use App\Models\Instituicao;
use App\Models\InstituicaoCurso;
use Illuminate\Support\Facades\DB;

class InstituicaoService
{
    public function store(InstituicaoRequest $request)
    {

        try {
            DB::beginTransaction();

            $instituicao         = new Instituicao();
            $instituicao->nome   = $request->nome;
            $instituicao->cnpj   = $request->cnpj;
            $instituicao->status = $request->status;

            $instituicao->save();
            DB::commit();

            return ['status' => 200, 'instituicao' => $instituicao];

        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function update(InstituicaoRequest $request, $id)
    {

        try {
            $instituicao         = Instituicao::findOrFail($id);

            $instituicao->nome   = $request->nome;
            $instituicao->cnpj   = $request->cnpj;
            $instituicao->status = $request->status;

            $instituicao->save();

            return ['status' => 200, 'instituicao' => $instituicao];

        } catch (\Exception $e) {

            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function addCurso(InstituicaoCursoRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $instituicaoCurso = new InstituicaoCurso();
            $instituicaoCurso->instituicao_id = $id;
            $instituicaoCurso->curso_id = $request->curso;
            $instituicaoCurso->save();

            $curso = Curso::findOrFail($request->curso);

            DB::commit();
            return ['status' => 200, 'response' => ['id' => $instituicaoCurso->curso_id, 'nome' => $curso->nome]];

        } catch (\Exception $e) {

            DB::rollBack();
            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function destroy($id)
    {
        $instituicao = Instituicao::with('cursos', 'alunos')->findOrFail($id);

        if(count($instituicao->cursos) > 0) {
            return ['status' => 400, 'response' => "A Instituição possui cursos ativos"];
        }

        if(count($instituicao->alunos) > 0) {
            return ['status' => 400, 'response' => "A Instituição possui alunos ativos"];
        }

        DB::beginTransaction();

        try {
            $instituicao->delete();
            DB::commit();
            return ['status' => 200, 'response' => "A Instituição foi deletada"];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 400, 'response' => "Houve um erro ao deletar a instituição"];
        }
    }
}
