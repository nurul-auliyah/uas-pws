<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mengajar', function (Blueprint $table) {
            $table->bigIncrements('mengajar_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('dosen_id');
            $table->timestamps();

            // kalau mau pakai foreign key (opsional)
            // $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
            // $table->foreign('dosen_id')->references('dosen_id')->on('dosen')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mengajar');
    }
};
