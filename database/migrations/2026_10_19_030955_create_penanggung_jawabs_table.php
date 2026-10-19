<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penanggung_jawab', function (Blueprint $table) {
            $table->id();
            $table->string('nip_nutpk')->nullable()->unique();

            $table->string('nama_lengkap');
            $table->string('jabatan');
            $table->foreignId('id_lokasi')
                ->unique()
                ->constrained('lokasi')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('no_telepon', 20)->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['aktif', 'tidak'])
                ->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penanggung_jawab');
    }
};