<?php
/**
 * Created by PhpStorm.
 * User: Vinicius
 * Date: 2019-09-22
 * Time: 10:38
 */

namespace App\services;


use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Models\InstituicaoCurso;
use Illuminate\Support\Facades\DB;

class CursoService
{
    public function store(CursoRequest $request)
    {

        try {
            DB::beginTransaction();
            $curso          = new Curso();
            $curso->nome    = $request->nome;
            $curso->duracao = $request->duracao;
            $curso->status  = $request->status;
            $curso->save();
            DB::commit();

            return ['status' => 200, 'curso' => $curso];

        } catch (\Exception $e) {

            DB::rollBack();
            return ['status' => 400, 'response' => $e->getMessage()];
        }


    }

    public function update(CursoRequest $request, $id)
    {

        try {
            $curso         = Curso::findOrFail($id);

            $curso->nome    = $request->nome;
            $curso->duracao = $request->duracao;
            $curso->status  = $request->status;

            $curso->save();


            return ['status' => 200, 'curso' => $curso];

        } catch (\Exception $e) {

            return ['status' => 400, 'response' => $e->getMessage()];
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $curso = Curso::with('alunos')->findOrFail($id);

        if(count($curso->alunos) > 0) {
            return ['status' => 400, 'response' => "O curso possui alunos ativos"];
        }

        try {
            $curso->delete();
            DB::commit();
            return ['status' => 200, 'response' => "O Curso foi deletado"];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 400, 'response' => "Houve um erro ao deletar o curso"];
        }
    }
}
