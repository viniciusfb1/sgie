@extends('layouts.app')

@section('scripts')
    <script>
        $('#cpf').mask('000.000.000-00');
        $('#celular').mask('(00) 0 0000-0000');
        $('#cep').mask('00000-000');

        $('#instituicao').on('change', function(){
            let _val = $(this).val();
            let _url = "{{ route("instituicoes.show", '') }}/"+_val;

            if(_val != '') {
                $.ajax({
                    type: 'GET',
                    data: {'id' : _val},
                    url: _url,
                    beforeSend: function(xhr) {
                        let _html = "<option value=''>...</option>";
                        $('#curso').html(_html);
                    },
                    success: function(resp) {
                        let _html = "<option value=''>Selecione</option>";
                        if(resp.length > 0) {
                            $.each(resp, function(k, v) {
                                _html += "<option value='"+v.id+"'>"+v.nome+"</option>";

                            });
                            $('#curso').html(_html);
                        }
                    },
                    error: function(error) {

                    }
                });
            } else {
                let _html = "<option value=''>Selecione</option>";
                $('#curso').html(_html);
            }
        });
    </script>
@stop

@section('content')
    <div class="container-fluid">
        <div class="col-12 col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cursos.index') }}">Cursos</a></li>
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
            @include('formularios.aluno')
        </div>
    </div>

@stop
