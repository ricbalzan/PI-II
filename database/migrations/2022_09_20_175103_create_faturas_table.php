<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->date('data_insercao')->nullable();
            $table->integer('mes');
            $table->decimal('valor');
        });

        Schema::table('faturas', function (Blueprint $table) {
            $table->unsignedBigInteger('numero_id');
            $table->foreign('numero_id')->references('id')->on('numeros');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faturas');
    }
}
