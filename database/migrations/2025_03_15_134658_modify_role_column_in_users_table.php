<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        DB::statement("UPDATE users SET role = 'user' WHERE role NOT IN ('user', 'umkm', 'pending', 'admin') OR role IS NULL");
        DB::statement("ALTER TABLE users MODIFY role ENUM('user', 'umkm', 'pending', 'admin') NOT NULL DEFAULT 'user'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('user', 'umkm', 'pending','admin') NOT NULL DEFAULT 'user'");
    }
};
