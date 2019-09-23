<div class="modal fade" id="modalInstituicao{{ $curso }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title w-100 text-center" id="instituicao_modal_label">Instituições</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h4>Lista de instituições que possuem o curso </h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($instituicao as $inst)
                        <tr>
                            <td>{{ $inst->nome }}</td>
                            <td>{{ $inst->cnpj }}</td>
                            <td>{{ $inst->status == 1 ? "Ativo" : "Inativo" }}</td>
                            <td>
                                <a href="{{ route('instituicoes.edit', ['id' => $inst]) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $inst->id }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Não há instituição para esse curso</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
