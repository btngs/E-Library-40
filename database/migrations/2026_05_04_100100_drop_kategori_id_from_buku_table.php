<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('buku', 'kategori_id')) {
            return;
        }

        Schema::table('buku', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('buku', 'kategori_id')) {
            return;
        }

        Schema::table('buku', function (Blueprint $table) {
            $table->foreignId('kategori_id')
                ->nullable()
                ->constrained('kategori')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }
};
