<div class="modal fade" id="addInstituicao{{ $instituicao->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route('vincular-instituicao', [$instituicao->id]) }}" class="vincular-curso-aluno" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title w-100 text-center" id="modalAddCursoLabel{{ $instituicao->id }}">Vincular curso</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4>Selecione  um curso para vincular a instituicao</h4>
                    <div class="col-12 col-lg-12" id="cursos">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label for="cursos">Cursos</label>
                                    <select name="curso" id="curso" class="form-control @error('curso') is-invalid @enderror">
                                        <option value="">Selecione</option>
                                        @foreach($instituicao->cursos as $curso)
                                            <option  value="{{ $curso->id }}">{{ $curso->nome }}</option>
                                        @endforeach
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
