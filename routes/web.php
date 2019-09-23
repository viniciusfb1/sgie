<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/instituicoes', 'InstituicoesController')->middleware('auth');
Route::resource('/cursos', 'CursoController')->middleware('auth');
Route::resource('/alunos', 'AlunoController')->middleware('auth');

// Rota acessada via ajax para vincular alunos a cursos
Route::post('/aluno/curso/{id}', 'AlunoController@addCurso')->name('vincular-curso');

// Rota acessada via ajax para vincular cursos a instituicao
Route::post('/instituicao/curso/{id}', 'InstituicaoController@addCurso')->name('vincular-instituicao');
