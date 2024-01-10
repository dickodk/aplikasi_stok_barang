<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('detail_barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang');
            $table->bigInteger('id_barang_keluar')->nullable();
            $table->integer('qty')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barang_keluars');
    }
};
