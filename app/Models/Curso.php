<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;

    public function instituicao()
    {
        return $this->belongsToMany(Instituicao::class, 'instituicao_cursos')->where('instituicao_cursos.status', 1);
    }

    public function alunos()
    {
        return $this->hasManyThrough(Aluno::class, AlunoCurso::class, 'aluno_id', 'id', 'id');
    }
}
