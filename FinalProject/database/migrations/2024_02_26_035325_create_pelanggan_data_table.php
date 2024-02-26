<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganDataTable extends Migration
{
    public function up()
    {
        Schema::create('pelanggan_data', function (Blueprint $table) {
            $table->id('pelanggan_data_id');
            $table->unsignedBigInteger('pelanggan_data_pelanggan_id');
            $table->enum('pelanggan_data_jenis', ['ktp', 'sim']);
            $table->string('pelanggan_data_file', 255);
            $table->timestamps();

            $table->foreign('pelanggan_data_pelanggan_id')->references('pelanggan_id')->on('pelanggan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan_data');
    }
}
