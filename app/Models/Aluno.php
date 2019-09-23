<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use SoftDeletes;

    protected $table = 'alunos';

    public function curso()
    {
        return $this->hasManyThrough(Curso::class, AlunoCurso::class, 'aluno_id', 'id', 'id', 'id');
    }

    public function instituicao()
    {
        return $this->belongsToMany(Instituicao::class, 'instituicao_alunos');
    }
}
