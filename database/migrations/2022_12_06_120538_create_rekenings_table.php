<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekenings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pegawai')
            ->unsigned();
            $table->string('nomorrekening')->unique();
            $table->timestamps();
            $table->foreign('id_pegawai')
            ->references('id')->on('pegawais') // id yang didapat dari table pegawai.
              ->onDelete('cascade')
              ->onUpdate('cascade');
            });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekenings');
    }
};
