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
        Schema::create('biayas', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan', 100)->required();
            $table->foreignId('nama_pegawai')->references('id')->on('pegawais')->onDelete('restrict');
            $table->string('lokasi', 100)->required();
            $table->date('hari_tgl', 100)->required();
            $table->string('rekening')->required();
            $table->string('uang_harian')->required();
            $table->string('uang_transport')->required();
            $table->string('biaya_transport')->required();
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
        Schema::dropIfExists('biayas');
    }
};
