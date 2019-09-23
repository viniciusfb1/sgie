<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instituicao extends Model
{
    use SoftDeletes;

    protected $table = 'instituicoes';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome',
        'cnpj',
        'status'
    ];

    public function cursos()
    {
        return $this->hasManyThrough(Curso::class, InstituicaoCurso::class, 'instituicao_id', 'id', 'id', 'id');
    }

    public function alunos()
    {
        return $this->hasManyThrough(Aluno::class, InstituicaoAluno::class, 'aluno_id', 'id', 'id');
    }
}
