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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('prodi_id');
            $table->string('alamat');
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamps();

            // Foreign Key
            $table->foreign('prodi_id')
                  ->references('prodi_id')
                  ->on('prodi')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
