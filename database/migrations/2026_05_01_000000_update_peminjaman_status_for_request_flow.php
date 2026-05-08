<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if (Schema::hasTable('peminjaman')) {
            DB::statement("ALTER TABLE peminjaman MODIFY status ENUM('menunggu', 'dipinjam', 'dikembalikan') NOT NULL DEFAULT 'menunggu'");
            DB::statement("ALTER TABLE peminjaman MODIFY tanggal_kembali DATE NULL");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if (Schema::hasTable('peminjaman')) {
            DB::statement("ALTER TABLE peminjaman MODIFY status ENUM('dipinjam', 'dikembalikan') NOT NULL DEFAULT 'dipinjam'");
            DB::statement("ALTER TABLE peminjaman MODIFY tanggal_kembali DATE NOT NULL");
        }
    }
};
