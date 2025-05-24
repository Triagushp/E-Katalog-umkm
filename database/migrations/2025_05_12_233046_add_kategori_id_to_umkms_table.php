<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('name');

            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
