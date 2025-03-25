<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->bigIncrements('izin_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kategori_izin_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['pending', 'disetujui', 'ditolak']);
            $table->text('alasan')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_izin_id')->references('detail_izin_id')->on('kategori_izins')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('izins');
    }
};
