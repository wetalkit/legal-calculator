<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProcedureItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('procedure_id')->unsigned();
            $table->string('label', 100);
            $table->string('name', 50);
            $table->tinyInteger('type');
            $table->text('options');
            $table->text('comments');
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
        Schema::dropIfExists('procedure_items');
    }
}
