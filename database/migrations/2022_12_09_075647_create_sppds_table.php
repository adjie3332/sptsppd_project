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
        Schema::create('sppds', function (Blueprint $table) {
            $table->id();
            $table->string('maksud_perintah', 100)->required();
            $table->string('transportasi', 100)->required();
            $table->string('tempat_berangkat', 100)->required();
            $table->string('tempat_tujuan', 100)->required();
            $table->date('tgl_pergi')->required();
            $table->date('tgl_kembali')->required();
            $table->foreignId('pejabat_pemerintah')->references('id')->on('pegawais')->onDelete('restrict');
            $table->foreignId('pejabat_diperintah')->references('id')->on('pegawais')->onDelete('restrict');
            $table->string('instansi', 100)->required();
            $table->string('mata_anggaran', 100)->required();
            $table->string('keterangan', 1000)->nullable();
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
        Schema::dropIfExists('sppds');
    }
};
