@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-12 col-lg-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{ route('home') }}">Home</a></li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-6">
            <div class="card">
                <div class="card-header bg-warning text-white">Cursos Recentes</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Duração</th>
                                <th>Status</th>
                                <th>Data de Criação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">Alunos Recentes</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
