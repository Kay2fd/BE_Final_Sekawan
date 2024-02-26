<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaanDetailTable extends Migration
{
    public function up()
{
    Schema::create('penyewaan_detail', function (Blueprint $table) {
        $table->id('penyewaan_detail_id');
        $table->foreignId('penyewaan_detail_penyewaan_id')->constrained('penyewaan', 'penyewaan_id'); 
        $table->foreignId('penyewaan_detail_alat_id')->constrained('alat');
        $table->integer('penyewaan_detail_jumlah');
        $table->integer('penyewaan_detail_subharga');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('penyewaan_detail');
    }
}
