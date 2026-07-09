<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_instances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('kode_unik')->unique();
            $table->enum('status_ketersediaan', ['Tersedia', 'Dipinjam', 'Maintenance'])->default('Tersedia');
            $table->enum('kondisi_barang', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_instances');
    }
};