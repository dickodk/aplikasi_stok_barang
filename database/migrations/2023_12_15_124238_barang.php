<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->nullable();
            $table->bigInteger('harga_jual')->nullable();
            $table->integer('qty')->nullable();
            // $table->integer('id_jenis_barang')->nullable();
            $table->timestamps();
            $table->foreignId('jenis_barangs_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
