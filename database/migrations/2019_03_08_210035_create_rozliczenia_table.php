<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRozliczeniaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rozliczenia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('opis');
            $table->unsignedInteger('pracownik_id');
            $table->foreign('pracownik_id')->references('id')->on('pracownicy');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rozliczenia');
    }
}
