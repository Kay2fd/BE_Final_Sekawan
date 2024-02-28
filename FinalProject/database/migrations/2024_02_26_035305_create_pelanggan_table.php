<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('pelanggan_id');
            $table->string('pelanggan_nama', 200);
            $table->string('pelanggan_alamat', 200);
            $table->char('pelanggan_notelp', 13)->nullable();
            $table->string('pelanggan_email', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
