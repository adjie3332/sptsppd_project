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
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->required()->default('DINAS KETAHANAN PANGAN');
            $table->string('alamat')->required()->default('Jl. Nusantara No. 1');
            $table->string('telepon')->required()->default('(0276) 325174');
            $table->string('faksimile')->required()->default('(0276) 325174');
            $table->string('website')->required()->default('www.ketahananpangan.boyolali.go.id');
            $table->string('email')->required()->default('dkp@boyolali.go.id');
            $table->integer('kodepos')->required()->default('57312');
            $table->foreignId('kepala_dinas')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('sekretaris')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('kabid_KKP')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('kabid_KDCP')->references('id')->on('pegawais')->onDelete('restrict');
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
        Schema::dropIfExists('instansi');
    }
};
