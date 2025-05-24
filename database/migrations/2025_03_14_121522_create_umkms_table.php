<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relasi ke user yang mengajukan
            $table->string('name');
            $table->string('No hp')->nullable();
            $table->text('alamat');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
          
            // Informasi Rekening (Opsional)
            $table->string('akun_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();

            $table->boolean('is_approved')->default(false); // Status persetujuan
            $table->timestamps();

            // Foreign Key (optional, kalau kamu pakai relasi)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
