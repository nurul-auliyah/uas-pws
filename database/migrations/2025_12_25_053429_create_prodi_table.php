<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('prodi', function (Blueprint $table) {
            $table->id('prodi_id');
            $table->foreignId('fakultas_id')
                  ->constrained('fakultas', 'fakultas_id')
                  ->cascadeOnDelete();
            $table->string('prodi_code', 10)->unique();
            $table->string('prodi_name', 100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};