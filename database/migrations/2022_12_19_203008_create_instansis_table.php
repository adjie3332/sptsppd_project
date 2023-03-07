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
            $table->string('nama')->required()->default('Dinas Komunikasi dan Informatika');
            $table->string('alamat')->required()->default('Jl. Lawu No. 385 B Karanganyar');
            $table->string('telepon')->required()->default('(0271) 495039');
            $table->string('faksimile')->required()->default('(0271) 495590');
            $table->string('website')->required()->default('www.karanganyarkab.go.id');
            $table->string('email')->required()->default('diskominfo@karanganyarkab.go.id');
            $table->integer('kodepos')->required()->default('57712');
            $table->foreignId('kepala_dinas')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('pejabat_pelaksana')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('bendahara')->references('id')->on('pegawais')->onDelete('restrict');
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
