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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->string('nomor_surat')->nullable();
            $table->string('maksud_perintah')->required();
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
            $table->string('tgl_keluar')->required();
            $table->string('tempat_tujuan_1', 100)->nullable();
            $table->date('tgl_tiba_1')->nullable();
            $table->date('tgl_berangkat_dari_1')->nullable();
            $table->string('tempat_tujuan_2', 100)->nullable();
            $table->date('tgl_tiba_2')->nullable();
            $table->date('tgl_berangkat_dari_2')->nullable();
            $table->string('tempat_tujuan_3', 100)->nullable();
            $table->date('tgl_tiba_3')->nullable();
            $table->date('tgl_berangkat_dari_3')->nullable();
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
