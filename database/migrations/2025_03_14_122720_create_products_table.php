<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->unsignedDecimal('price', 10, 2); // Harga tidak bisa negatif
            $table->unsignedInteger('stock')->default(0); // Stok tidak bisa negatif
            $table->string('image')->nullable();
            $table->foreignId('umkm_id')
                ->constrained('umkms')
                ->cascadeOnUpdate()
                ->cascadeOnDelete(); // Jika UMKM dihapus, produk ikut terhapus
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
