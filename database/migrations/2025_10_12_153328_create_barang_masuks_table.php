<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id('idmasuk');
            $table->unsignedBigInteger('idbarang');
            $table->date('tanggal');
            $table->string('penerima');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('idbarang')
                  ->references('idbarang')
                  ->on('stok_barangs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
