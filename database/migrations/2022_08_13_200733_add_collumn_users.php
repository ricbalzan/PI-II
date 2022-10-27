<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCollumnUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('endereco')->nullable();
            $table->string('cidade')->nullable();
            $table->string('data_nasc')->nullable();
            $table->string('cpf')->nullable();
            $table->string('rg')->nullable();
            $table->string('situacao')->nullable();
            $table->string('tipo')->nullable();
            $table->string('num_func')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('endereco');
            $table->dropColumn('cidade');
            $table->dropColumn('data_nasc');
            $table->dropColumn('cpf');
            $table->dropColumn('rg');
            $table->dropColumn('situacao');
            $table->dropColumn('tipo');
            $table->dropColumn('num_func');
        });
    }
}
