<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::create('detail_barang_masuks', function (Blueprint $table) {
            $table->id();
            // $table->string('id_barang');
            // $table->bigInteger('id_barang_masuk')->nullable();
            $table->integer('qty')->nullable();
            $table->bigInteger('harga_beli')->nullable();
            $table->timestamps();
            $table->foreignId('barang_masuks_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
            $table->foreignId('barangs_id')->constrained()->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_barang_masuks');
    }
};
