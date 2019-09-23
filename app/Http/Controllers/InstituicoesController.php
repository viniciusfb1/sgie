<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituicaoCursoRequest;
use App\Http\Requests\InstituicaoRequest;
use App\Models\Instituicao;
use App\services\InstituicaoService;
use Illuminate\Http\Request;

class InstituicoesController extends Controller
{
    public $service;

//    instancia o serviço de instituicao para livrar a controller de muita lógica
    public function __construct(InstituicaoService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituicoes = Instituicao::with('cursos')->paginate(10);

        return view('instituicao.index', compact('instituicoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instituicao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstituicaoRequest $request)
    {
//        servico que faz o insert no banco de dados
        $instituicao = $this->service->store($request);

        if($instituicao['status'] === 200) {
            return redirect()->route('instituicoes.index')->with(['success' => 'Instituição criada com sucesso']);
        } else {
            return back()->withErrors($instituicao['response']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function show(Instituicao $instituicao, $id)
    {
//        metodo utilizado via ajax para carregar cursos por instituicoes
        $inst = $instituicao->where('id', $id)->with(['cursos' => function($q){
            $q->where('instituicao_cursos.status', 1);
        }])->first();

        return $inst->cursos->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Instituicao $instituicao, $id)
    {
        return view('instituicao.edit', ['instituicao' => $instituicao->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituicaoRequest  $request
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function update(InstituicaoRequest $request, Instituicao $instituicao, $id)
    {
//        servico que faz o update da instituicao no banco de dados
        $service = $this->service->update($request, $id);

        if($service['status'] === 200) {
            return redirect()->route('instituicoes.edit', ['id' => $id])->with(['success' => 'Instituição atualizada com sucesso']);
        } else {
            return back()->withErrors($service['response']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instituicao  $instituicao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        servico que faz o delete da instituicao no banco de dados, utilizando softdeletes
        $instituicao = $this->service->destroy($id);

        if($instituicao['status'] === 200) {
            return redirect()->route('instituicoes.index')->with(['success' => 'Instituição deletada com sucesso']);
        } else {
            return back()->with(['error' => $instituicao['response']]);
        }
    }

    /**
     * Add course to student
     * @param Request $request
     *
     * @return array
     */
    public function addCurso(InstituicaoCursoRequest $request, $id)
    {
//        metodo que faz o vinculo de um curso com uma instituicao
        $response = $this->service->addCurso($request, $id);

        return $response['response'];
    }

}
