<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaoAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_alunos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instituicao_id');
            $table->unsignedBigInteger('aluno_id');
            $table->timestamps();
            $table->softDeletes();

            // adicionando foreign key da instituicao
//            $table->foreign('instituicao_id')
//                ->references('id')
//                ->on('instituicao')
//                ->onDelete('cascade');

            // adicionando foreign key do aluno
//            $table->foreign('aluno_id')
//                ->references('id')
//                ->on('aluno')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicao_alunos');
    }
}
