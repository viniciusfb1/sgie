<form action="{{ !isset($instituicao) ? route('instituicoes.store') : route('instituicoes.update', ['id' => $instituicao])}}" method="post">
    @csrf
    @if(isset($instituicao))
        @method('PUT')
    @endif
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="card-title mb-0 text-white">
                @if(!isset($instituicao))
                    Cadastrar nova instituição
                @else
                    Instituição {{ $instituicao->nome }}
                @endif
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" value="{{ isset($instituicao) ? $instituicao->nome : old('nome') }}" name="nome" class="form-control @error('nome') is-invalid @enderror">
                        @if($errors->has('nome'))
                            @foreach($errors->get('nome') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" value="{{ isset($instituicao) ? $instituicao->cnpj : old('cnpj') }}" class="form-control @error('cnpj') is-invalid @enderror">
                        @if($errors->has('cnpj'))
                            @foreach($errors->get('cnpj') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">Selecione</option>
                            <option {{ isset($instituicao) ? ($instituicao->status == '1' ? 'selected' : "") : (old('status') == '1' ? 'selected' : '')}} value="1">Ativo</option>
                            <option {{ isset($instituicao) ? ($instituicao->status == '0' ? 'selected' : "") : (old('status') == '0' ? 'selected' : '')}} value="0">Inativo</option>
                        </select>
                        @if($errors->has('status'))
                            @foreach($errors->get('status') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('instituicoes.index') }}" class="btn btn-sm btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-sm btn-success float-right">Salvar</button>
        </div>
    </div>
</form>
