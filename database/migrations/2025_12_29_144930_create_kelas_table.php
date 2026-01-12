<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('kelas_id');
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->string('kelas_code', 50)->unique();
            $table->string('kelas_name', 100);
            $table->timestamps();

            // Jika mau pakai foreign key (opsional)
            // $table->foreign('prodi_id')->references('id')->on('prodi');
            // $table->foreign('mata_kuliah_id')->references('id')->on('mata_kuliah');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
