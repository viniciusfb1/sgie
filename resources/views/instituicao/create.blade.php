@extends('layouts.app')

@section('scripts')
    <script>
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('instituicoes.index') }}">Instituições</a></li>
                    <li class="breadcrumb-item active">Cadastrar</li>
                </ol>
            </nav>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <div class="col-12 col-lg-12">
            @include('formularios.instituicao')
        </div>
    </div>

@stop
