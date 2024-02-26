<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('kategori_nama', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
