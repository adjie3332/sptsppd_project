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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            // $table->bigInteger('nip')->primary();
            $table->string('name', 100)->required();
            // $table->integer('nip', 100, false, false)->unique()->required();
            // $table->integer('nip')->length(100)->required();
            $table->string('jabatan', 100)->required();
            $table->string('pangkat', 100)->required();
            $table->string('golongan', 10)->required();
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
        Schema::dropIfExists('pegawais');
    }
};
