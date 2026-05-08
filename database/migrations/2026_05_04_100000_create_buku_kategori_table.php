<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('buku')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['buku_id', 'kategori_id']);
        });

        if (Schema::hasColumn('buku', 'kategori_id')) {
            $pairs = DB::table('buku')
                ->whereNotNull('kategori_id')
                ->select('id as buku_id', 'kategori_id')
                ->get()
                ->map(fn ($item) => [
                    'buku_id' => $item->buku_id,
                    'kategori_id' => $item->kategori_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
                ->all();

            if ($pairs !== []) {
                DB::table('buku_kategori')->insert($pairs);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_kategori');
    }
};
