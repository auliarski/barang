<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel admins.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama admin
            $table->string('email')->unique(); // Email unik
            $table->string('password'); // Password terenkripsi
            $table->string('phone')->nullable(); // Nomor HP opsional
            $table->string('avatar')->nullable(); // Foto profil opsional
            $table->rememberToken(); // Token untuk remember me
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Hapus tabel admins jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
