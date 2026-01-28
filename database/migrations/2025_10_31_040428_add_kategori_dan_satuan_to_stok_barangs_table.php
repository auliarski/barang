<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('stok_barangs', function (Blueprint $table) {
            $table->string('kategori')->after('nama_barang')->nullable();
            $table->string('satuan')->after('stok')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stok_barangs', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'satuan']);
        });
    }
};
