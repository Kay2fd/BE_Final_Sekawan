<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->id('alat_id');
            $table->foreignId('alat_kategori_id')->constrained();
            $table->string('alat_nama', 150);
            $table->string('alat_deskripsi', 255);
            $table->integer('alat_hargaperhari');
            $table->integer('alat_stok');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alat');
    }
}