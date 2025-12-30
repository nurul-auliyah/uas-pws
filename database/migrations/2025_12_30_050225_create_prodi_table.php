<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id('prodi_id');
            $table->unsignedBigInteger('fakultas_id');
            $table->string('prodi_code', 20)->unique();
            $table->string('prodi_name', 100);
            $table->timestamps();

            // foreign key
            $table->foreign('fakultas_id')
                  ->references('fakultas_id')
                  ->on('fakultas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
