<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('curso_id');
            $table->timestamps();
            $table->softDeletes();

            // adicionando foreign key do aluno
//            $table->foreign('aluno_id')
//                ->references('id')
//                ->on('aluno')
//                ->onDelete('cascade');

            // adicionando foreign key do curso
//            $table->foreign('curso_id')
//                ->references('id')
//                ->on('curso')
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
        Schema::dropIfExists('aluno_cursos');
    }
}
