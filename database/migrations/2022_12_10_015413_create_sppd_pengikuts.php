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
        Schema::create('sppd_pengikuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')->references('id')->on('sppds');
            $table->foreignId('pegawai_id')->references('id')->on('pegawais');
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
        Schema::dropIfExists('sppd_pengikuts');
    }
};
