<div class="modal fade" id="addCurso{{ $aluno->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('vincular-curso', [$aluno->id]) }}" class="vincular-curso-aluno" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title w-100 text-center" id="modalAddCursoLabel{{ $aluno->id }}">Vincular curso</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4>Selecione a instituição e um curso para vincular o aluno</h4>
                    <div class="col-12 col-lg-12" id="insituicoes">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="instituicao">Instituição</label>
                                    <select name="instituicao" id="instituicao" class="form-control @error('instituicao') is-invalid @enderror">
                                        <option value="">Selecione</option>
                                        @foreach($instituicoes as $instituicao)
                                            <option  value="{{ $instituicao->id }}">{{ $instituicao->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="curso">Curso</label>
                                    <select name="curso" id="curso" class="form-control @error('curso') is-invalid @enderror">
                                        <option value="">Selecione</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Não</button>
                    <button type="submit" class="btn btn-success btn-sm">Sim</button>
                </div>
            </div>
        </form>
    </div>
</div>
