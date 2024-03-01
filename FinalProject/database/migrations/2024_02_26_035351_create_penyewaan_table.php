<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaanTable extends Migration
{
    public function up()
    {
        Schema::create('penyewaan', function (Blueprint $table) {
            $table->id('penyewaan_id');
            $table->unsignedBigInteger('penyewaan_pelanggan_id');
            $table->date('penyewaan_tgl_sewa')->nullable();
            $table->enum('penyewaan_stts_bayar', ['lunas', 'belum lunas', 'dp'])->default('belum lunas');
            $table->enum('penyewaan_stts_kembali', ['sudah kembali', 'belum kembali'])->default('belum kembali');
            $table->integer('penyewaan_totalharga');
            $table->timestamps();

            $table->foreign('penyewaan_pelanggan_id')->references('pelanggan_id')->on('pelanggan');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyewaan');
    }
}
