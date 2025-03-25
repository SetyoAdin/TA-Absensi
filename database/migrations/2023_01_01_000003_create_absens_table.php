<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->bigIncrements('absen_id');
            $table->unsignedBigInteger('user_id')->nullable(); // Bisa null
            $table->unsignedBigInteger('kategori_izin_id')->nullable();
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->string('gambar')->nullable();
            $table->text('alasan')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_izin_id')->references('detail_izin_id')->on('kategori_izins')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('absens');
    }
};
