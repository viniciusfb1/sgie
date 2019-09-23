<form action="{{ !isset($aluno) ? route('alunos.store') : route('alunos.update', ['id' => $aluno])}}" method="post">
    @csrf
    @if(isset($aluno))
        @method('PUT')
    @endif
    <div class="card">
        <div class="card-header bg-warning">
            <h3 class="card-title mb-0 text-white">
                @if(!isset($aluno))
                    Cadastrar novo aluno
                @else
                    Aluno {{ $aluno->nome }}
                @endif
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" value="{{ isset($aluno) ? $aluno->nome : old('nome') }}" name="nome" class="form-control @error('nome') is-invalid @enderror">
                        @if($errors->has('nome'))
                            @foreach($errors->get('nome') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" value="{{ isset($aluno) ? $aluno->cpf : old('cpf') }}" class="form-control @error('cpf') is-invalid @enderror">
                        @if($errors->has('cpf'))
                            @foreach($errors->get('cpf') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="data_nasc">Data. Nascimento</label>
                        <input type="date" id="data_nasc" name="data_nasc" value="{{ isset($aluno) ? $aluno->data_nasc : old('data_nasc') }}" class="form-control @error('data_nasc') is-invalid @enderror">
                        @if($errors->has('data_nasc'))
                            @foreach($errors->get('data_nasc') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ isset($aluno) ? $aluno->email : old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-md-4">
                    <div class="form-group">
                        <label for="celular">Celular</label>
                        <input type="tel" id="celular" name="celular" value="{{ isset($aluno) ? $aluno->celular : old('celular') }}" class="form-control @error('celular') is-invalid @enderror">
                        @if($errors->has('celular'))
                            @foreach($errors->get('celular') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-3">
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input type="text" id="cep" name="cep" value="{{ isset($aluno) ? $aluno->cep : old('cep') }}" class="form-control @error('cep') is-invalid @enderror">
                        @if($errors->has('cep'))
                            @foreach($errors->get('cep') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-7 col-md-7">
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" id="endereco" name="endereco" value="{{ isset($aluno) ? $aluno->endereco : old('endereco') }}" class="form-control @error('endereco') is-invalid @enderror">
                        @if($errors->has('endereco'))
                            @foreach($errors->get('endereco') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-2 col-md-2">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" id="numero" name="numero" value="{{ isset($aluno) ? $aluno->numero : old('numero') }}" class="form-control @error('numero') is-invalid @enderror">
                        @if($errors->has('numero'))
                            @foreach($errors->get('numero') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" name="bairro" value="{{ isset($aluno) ? $aluno->bairro : old('bairro') }}" class="form-control @error('bairro') is-invalid @enderror">
                        @if($errors->has('bairro'))
                            @foreach($errors->get('bairro') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" id="cidade" name="cidade" value="{{ isset($aluno) ? $aluno->cidade : old('cidade') }}" class="form-control @error('cidade') is-invalid @enderror">
                        @if($errors->has('cidade'))
                            @foreach($errors->get('cidade') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="uf">Estado</label>
                        <input type="text" id="uf" name="uf" value="{{ isset($aluno) ? $aluno->uf : old('uf') }}" class="form-control @error('uf') is-invalid @enderror">
                        @if($errors->has('uf'))
                            @foreach($errors->get('uf') as $error)
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
                            <option {{ isset($aluno) ? ($aluno->status == '1' ? 'selected' : "") : (old('status') == '1' ? 'selected' : '')}} value="1">Ativo</option>
                            <option {{ isset($aluno) ? ($aluno->status == '0' ? 'selected' : "") : (old('status') == '0' ? 'selected' : '')}} value="0">Inativo</option>
                        </select>
                        @if($errors->has('status'))
                            @foreach($errors->get('status') as $error)
                                <span class="text-danger">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                @if(!isset($aluno))
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
                @endif
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('alunos.index') }}" class="btn btn-sm btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-sm btn-success float-right">Salvar</button>
        </div>
    </div>
</form>
