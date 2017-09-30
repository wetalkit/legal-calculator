<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatTableProceduresFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedure_id')->unsigned();
            $table->string('name', 100);
            $table->tinyInteger('category');
            $table->text('formula');
            $table->timestamps();
            $table->foreign('procedure_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedures_formulas');
    }
}
