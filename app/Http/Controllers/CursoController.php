<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Models\Instituicao;
use App\Models\InstituicaoCurso;
use App\services\CursoService;
use Illuminate\Http\Request;

class CursoController extends Controller
{

    public $service;
//    instancia o serviço de curso para livrar a controller de muita lógica
    public function __construct(CursoService $service)
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
        $cursos = Curso::with('instituicao')->paginate(10);

        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instituicoes = Instituicao::where('status', 1)->get();
        return view('cursos.create', compact('instituicoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequest $request)
    {
        //        servico que faz o insert no banco de dados
        $curso = $this->service->store($request);

        if($curso['status'] === 200) {
            return redirect()->route('cursos.index')->with(['success' => 'Curso criado com sucesso']);
        } else {
            return back()->withErrors($curso['response']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        $instituicoes = Instituicao::where('status', 1)->get();
        $cursos = $curso->findOrFail($curso->id)->with('instituicao')->first();

        return view('cursos.edit', ['curso' => $cursos, 'instituicoes' => $instituicoes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CursoRequest  $request
     * @param  \App\Models\Curso  $curso
     * @param  Int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CursoRequest $request, Curso $curso)
    {
        $service = $this->service->update($request, $curso->id);

        if($service['status'] === 200) {
            return redirect()->route('cursos.edit', ['id' => $curso->id])->with(['success' => 'Curso atualizado com sucesso']);
        } else {
            return back()->withErrors($service['response']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //        servico que faz o delete da instituicao no banco de dados, utilizando softdeletes
        $curso = $this->service->destroy($id);

        if($curso['status'] === 200) {
            return redirect()->route('cursos.index')->with(['success' => 'Curso deletado com sucesso']);
        } else {
            return back()->with(['error' => $curso['response']]);
        }
    }
}
