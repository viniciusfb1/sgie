<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstituicaoCurso extends Model
{
    use SoftDeletes;

    protected $table = 'instituicao_cursos';

    protected $fillable = [
        'curso_id',
        'instituicao_id',
        'status'
    ];
}
