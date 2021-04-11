<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePomocniczaZadaniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pomocnicza_zadania', function (Blueprint $table) {
            $table->unsignedInteger('rozliczenie_id');
            $table->unsignedInteger('zadanie_id');
            $table->foreign('rozliczenie_id')->references('id')->on('rozliczenia');
            $table->foreign('zadanie_id')->references('id')->on('zadania');
            $table->double('czas');
            $table->double('stawka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pomocnicza_zadania');
    }
}
