<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_cursos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instituicao_id');
            $table->unsignedBigInteger('curso_id');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            // adicionando foreign key da instituicao
//            $table->foreign('instituicao_id')
//                    ->references('id')
//                    ->on('instituicao')
//                    ->onDelete('cascade');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('instituicao_cursos');
    }
}
