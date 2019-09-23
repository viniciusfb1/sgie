<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlunoInstituicaoCursoRequest;
use App\Http\Requests\AlunoRequest;
use App\Models\Aluno;
use App\Models\Instituicao;
use App\services\AlunosService;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public $service;

//    instancia o serviço de aluno para livrar a controller de muita lógica
    public function __construct(AlunosService $service)
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
        $alunos = Aluno::paginate(20);

        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituicoes = Instituicao::where('status', 1)->with('cursos')->get();

        return view('alunos.create', compact('instituicoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoRequest $request)
    {
        //        servico que faz o insert no banco de dados
        $aluno = $this->service->store($request);

        if($aluno['status'] === 200) {
            return redirect()->route('alunos.index')->with(['success' => 'Aluno criado com sucesso']);
        } else {
            return back()->withErrors($aluno['response']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        $instituicoes = Instituicao::where('status', 1)->get();

        $al = $aluno->where('id', $aluno->id)->with('curso', 'instituicao')->first();

        return view('alunos.edit', ['instituicoes' => $instituicoes, 'aluno' => $al]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AlunoRequest  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(AlunoRequest $request, Aluno $aluno)
    {
        $al = $this->service->update($request, $aluno->id);

        if($aluno['status'] === 200) {
            return redirect()->route('alunos.index')->with(['success' => 'Aluno atualizado com sucesso']);
        } else {
            return back()->with(['error' => $aluno['response']]);
        }
    }

    /**
     * Add course to student
     * @param Request $request
     * @param Aluno $aluno
     *
     * @return array
     */
    public function addCurso(AlunoInstituicaoCursoRequest $request, Aluno $aluno, $id)
    {

        $response = $this->service->addCurso($request, $id);

        return $response['response'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
//        servico que faz o delete da instituicao no banco de dados, utilizando softdeletes
        $al = $this->service->destroy($aluno->id);

        if($al['status'] === 200) {
            return redirect()->route('alunos.index')->with(['success' => 'Aluno deletado com sucesso']);
        } else {
            return back()->with(['error' => $al['response']]);
        }
    }
}
