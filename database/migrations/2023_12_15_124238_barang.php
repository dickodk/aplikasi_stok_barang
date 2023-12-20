<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('id_jenis_barang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barang');
    }
};
