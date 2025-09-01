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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kat')->constrained('kategori')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug_berita')->unique();
            $table->longText('deskripsi');
            $table->foreignId('id_usr')->constrained('users')->onDelete('cascade');
            $table->string('image');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
